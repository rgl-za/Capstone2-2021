python
import RPi.GPIO as GPIO
import requests
import time
import spidev
import json
import urllib.request
 
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
 
#토양센서핀
DIGIT = 23
 
#수중펌프 모터1핀
A1A = 5
A1B = 6
 
#수중펌프 모터2핀
B1A = 26
B1B = 19
 
GPIO.setup(DIGIT,GPIO.IN)
 
GPIO.setup(A1A,GPIO.OUT)
GPIO.output(A1A,GPIO.LOW)
GPIO.setup(A1B,GPIO.OUT)
GPIO.output(A1B,GPIO.LOW)
 
GPIO.setup(B1A,GPIO.OUT)
GPIO.output(B1A,GPIO.LOW)
GPIO.setup(B1B,GPIO.OUT)
GPIO.output(B1B,GPIO.LOW)
 
spi=spidev.SpiDev()
spi.open(0,0)
spi.max_speed_hz=50000
 
farm_id='1' #라즈베리파이 id
old = "0" #시간 초기화
 
url_1 = "http://easyfarm.dothome.co.kr/db/user_data.php" #사용자가 키우는 품종의 정보
data_1 = urllib.request.urlopen(url_1).read().decode('utf-8')
j_1 = json.loads(data_1)
temp_1 = j_1[farm_id]['plant']
 
url_2 = "http://easyfarm.dothome.co.kr/db/raspberry.php" #품종에 대한 정보
data_2 = urllib.request.urlopen(url_2).read().decode('utf-8')
j_2 = json.loads(data_2)
temp_2 = j_2[temp_1]['water'] #품종의 물 공급량
 
def read_spi_adc(adcChannel):
    adcValue=0
    buff=spi.xfer2([1,(8+adcChannel)<<4,0])
    adcValue=((buff[1]&3)<<8)+buff[2]
    return adcValue
 
def map1(x, input_1, input_2, output_1,output_2):  #토양센서 데이터를 백분율로 나타내는 함수
    return (x-input_1) * (output_2-output_1)/(input_2-input_1)+output_1
 
try:
    while True:
        time.sleep(30)
        adcValue=read_spi_adc(0)
        print("soil: %d"%(adcValue))
        c = 100 - map1(adcValue,0,1023,0,100)
        #0: 수분이 많음 1023: 수분이 없음, 0 => 0%, 1023 =>100%
	#수분이 많을 때 100%를 나타내고 싶기 때문에 100에서 값을 빼줌.
        print(c)
        temp = temp_2.split("~") #범위로 표현되어있는 물 공급량을 배열로 저장
 
        #수분이 임계치보다 낮을 때 모터가 켜짐
        if float(temp[0]) > c:  
            adcValue=read_spi_adc(0)
            print("soil: %d"%(adcValue))
            c = 100 - map1(adcValue,0,1023,0,100)
            GPIO.output(A1A,GPIO.HIGH) #모터1이 켜짐
            GPIO.output(A1B,GPIO.LOW)
            GPIO.output(B1A,GPIO.HIGH) #모터2가 켜짐
            GPIO.output(B1B,GPIO.LOW)
            if float(temp[1]) < c:
                GPIO.output(A1A,GPIO.LOW) #모터1이 꺼짐
                GPIO.output(A1B,GPIO.LOW)
                GPIO.output(B1A,GPIO.LOW) #모터2가 꺼짐
                GPIO.output(B1B,GPIO.LOW)
 
        else:
            GPIO.output(A1A,GPIO.LOW)
            GPIO.output(A1B,GPIO.LOW)
            GPIO.output(B1A,GPIO.LOW)
            GPIO.output(B1B,GPIO.LOW)
 
        c=format(c,".2f")
 
        #1시간 간격으로 DB로 데이터 보내기
        hour = time.strftime('%H', time.localtime(time.time())) #현재 시간
        if old != hour:
            old = hour
 
            #웹에서 사용자가 품종을 바꿨을 경우 새로운 정보를 받아와서 반영함.
            url_1 = "http://easyfarm.dothome.co.kr/db/user_data.php" #사용자가 키우는 품종의 정보
            data_1 = urllib.request.urlopen(url_1).read().decode('utf-8')
            j_1 = json.loads(data_1)
            temp_1 = j_1[farm_id]['plant']
 
            url_2 = "http://easyfarm.dothome.co.kr/db/raspberry.php" #품종에 대한 정보
            data_2 = urllib.request.urlopen(url_2).read().decode('utf-8')
            j_2 = json.loads(data_2)
            temp_2 = j_2[temp_1]['water'] #품종의 물 공급량
 
            requests.post('http://easyfarm.dothome.co.kr/db/soil.php',{'farm_id':farm_id,'plant':temp_1,'moisture':c}).text #데이터 값을 웹서버로 보냄
finally:
    GPIO.cleanup()
    spi.close()

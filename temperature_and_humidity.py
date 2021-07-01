python
import Adafruit_DHT as dht
import RPi.GPIO as GPIO
import time
import requests
import json
import urllib.request
 
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
 
#온도센서
DIGIT = 4
 
#냉각팬
fan = 13
 
GPIO.setup(DIGIT,GPIO.IN)
GPIO.setup(fan,GPIO.OUT)
 
GPIO.output(fan,GPIO.LOW)
 
farm_id='1' #라즈베리파이 id
old = "0" #시간 초기화
count=0              
old_2 = "0"
 
url_1 = "http://easyfarm.dothome.co.kr/db/user_data.php" #사용자가 키우는 품종의 정보
data_1 = urllib.request.urlopen(url_1).read().decode('utf-8')
j_1 = json.loads(data_1)
temp_1 = j_1[farm_id]['plant']
 
url_2 = "http://easyfarm.dothome.co.kr/db/raspberry.php" #품종에 대한 정보
data_2 = urllib.request.urlopen(url_2).read().decode('utf-8')
j_2 = json.loads(data_2)
temp_2 = j_2[temp_1]['budding_temp'] #품종의 발아 온도
change_temp = j_2[temp_1]['upgrade'] #품종이 잘 자라는 온도
 
try:
    while True:
        time.sleep(1)
 
        t_1 = time.strftime('%Y-%m-%d', time.localtime(time.time())) #발아 온도에서 품종이 잘 자라는 온도로 바꿔주기 위해 날짜를 카운트 해줌
        if(old != t_1):
            count += 1
            old = t_1
 
        if(count == int(change_temp)): #발아 시기가 지나면 제어할 온도 범위를 바꿔줌
            temp_2 = j_2[temp_1]['good_temp']
 
        h,t = dht.read_retry(dht.DHT22, DIGIT)
        print("temp={0:0.1f}*C humidity={1:0.1f}%".format(t,h))
 
        temp = temp_2.split("~")
 
        if t > float(temp[1]): #온도와 습도가 임계치보다 높으면 냉각팬이 켜짐
            GPIO.output(fan,GPIO.HIGH)
           
        else:
            GPIO.output(fan,GPIO.LOW)
       
        t=format(t,".2f")
        h=format(h,".2f")
       
        #1시간 마다 DB로 데이터를 보냄
        t_2 = time.strftime('%H', time.localtime(time.time()))
        if old_2 != t_2:
            #웹에서 사용자가 품종을 바꿨을 경우 새로운 정보를 반영함.
            url_1 = "http://easyfarm.dothome.co.kr/db/user_data.php" #사용자가 키우는 품종의 정보
            data_1 = urllib.request.urlopen(url_1).read().decode('utf-8')
            j_1 = json.loads(data_1)
            temp_1 = j_1[farm_id]['plant']
 
            url_2 = "http://easyfarm.dothome.co.kr/db/raspberry.php" #품종에 대한 정보
            data_2 = urllib.request.urlopen(url_2).read().decode('utf-8')
            j_2 = json.loads(data_2)
            temp_2 = j_2[temp_1]['budding_temp'] #품종의 발아 온도
            change_temp = j_2[temp_1]['upgrade'] #품종이 잘 자라는 온도
 
            data = {'farm_id':farm_id, 'plant':temp_1, 'temperature': t, 'humidity':h}
            requests.post('http://easyfarm.dothome.co.kr/db/temperature.php',data=data).text #데이터 값을 웹서버로 보냄
            old_2 = t_2
 
finally:
    GPIO.cleanup() 

Python
import RPi.GPIO as GPIO
import time
import spidev
 
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
pins={'red':17, 'green':27, 'blue':22} #RGB LED 모듈의 R, G, B의 핀
 
for i in pins: #RGB LED 모듈의 R, G, B의 핀을 설정
    GPIO.setup(pins[i], GPIO.OUT)
    GPIO.output(pins[i], GPIO.HIGH)
 
red=GPIO.PWM(pins['red'], 2000) #초당 펄스의 주파수를 유지한 채, 펄스의 길이를 변화시키는 기술, 디지털 출력에 비해 모든 색상을 출력할 수 있음
green=GPIO.PWM(pins['green'], 2000)
blue=GPIO.PWM(pins['blue'], 2000)
   
spi = spidev.SpiDev()
spi.open(0,0)
spi.max_speed_hz = 1000000
 
def analog_read(channel):
    r=spi.xfer2([1,(8+channel)<<4,0])
    adc_out=((r[1]&3)<<8)+r[2]
    return adc_out
 
while True:
    voltage=analog_read(1)*3.3/1024 #수위센서에서 데이터를 가져옴
    print(voltage)
    time.sleep(1)
 
    red.start(0) #RGB LED 모듈 초기값 설정
    green.start(0)
    blue.start(0)
       
    if(voltage<1): #물의 높이가 임계치보다 낮으면 RGB LED 모듈이 빨간색으로 켜짐
        red.ChangeDutyCycle(100) #0~100까지 입력 가능, 밝기조절과 비슷 입력 값이 20이면 HIGH 20, LOW 80
        green.ChangeDutyCycle(0)
        blue.ChangeDutyCycle(0)
        time.sleep(1)
    else: #물이 충분히 있을 때 RGB LED 모듈이 꺼짐
        red.stop()
        green.stop()
        blue.stop()
        for i in pins:
            GPIO.output(pins[i],GPIO.LOW)
GPIO.cleanup()

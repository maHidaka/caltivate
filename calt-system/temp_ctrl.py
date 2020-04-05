import RPi.GPIO as GPIO
import time

import in_temp
import water_temp

water_heater = 22
air_heater = 17
light = 4
door = 5

GPIO.setmode(GPIO.BCM)
GPIO.setup(door, GPIO.IN)
GPIO.setup(air_heater, GPIO.OUT)
GPIO.setup(water_heater, GPIO.OUT)
GPIO.setup(light, GPIO.OUT)

def air_setTemp():
	a_tempData = open('/home/pi/caltivation/ctrl/airHeater_temp',"r")
	for val in a_tempData:
		temp_a = float(val)
	a_tempData.close()
	return temp_a

def water_setTemp():
	w_tempData = open('/home/pi/caltivation/ctrl/waterHeater_temp',"r")
	for val in w_tempData:
		temp_w = float(val)
	w_tempData.close()
	return temp_w

def temp_ctrl():
	Data = open('/home/pi/caltivation/ctrl/temp_ctrl',"r")
	for val in Data:
		t_flag = int(val)
	Data.close()
	return t_flag

def caltivation_ctrl():
	cData = open('/home/pi/caltivation/ctrl/caltivation_ctrl',"r")
	for val in cData:
		c_flag = int(val)
	cData.close()
	return c_flag

def light_ctrl():
	lData = open('/home/pi/caltivation/ctrl/light_ctrl',"r")
	for val in lData:
		l_flag = int(val)
	lData.close()
	return l_flag


while caltivation_ctrl():

	GPIO.output(light,light_ctrl())
	#	if  light_ctrl():
	#		GPIO.output(light,1)
	#	else:
	#		GPIO.output(light,0)

	if temp_ctrl():

		try:
			if  float(in_temp.readData()) < air_setTemp() :
				GPIO.output(air_heater, 1)
				print(in_temp.readData(),'ON')
				time.sleep(1)
			else:
				GPIO.output(air_heater, 0)
				print(in_temp.readData(),'OFF')
				time.sleep(1)
		except ValueError:
			print('An invalid value was entered in the air temperture　seting file. \n　error: run 'ValueError'\n')
			f = open('/home/pi/caltivation/ctrl/temp_ctrl','w')
			f.write('0')
			f.close()

		try:
			if  float(water_temp.readData()) < water_setTemp() :
				print(water_temp.readData(),'ON')
				GPIO.output(water_heater, 1)
				time.sleep(1)
				break

			else:
				GPIO.output(water_heater, 0)
				print(water_temp.readData(),'OFF')
				time.sleep(1)		
		except ValueError:
			print('An invalid value was entered in the water temperture　seting file. \n　error: run 'ValueError'\n')
			f = open('/home/pi/caltivation/ctrl/temp_ctrl','w')
			f.write('0')
			f.close()

		if  GPIO.input(door):
			f = open('/home/pi/caltivation/ctrl/temp_ctrl','w')
			f.write('0')
			f.close()
			print('door open ')

	else:
		GPIO.output(air_heater, 0)
		GPIO.output(water_heater, 0)
		time.sleep(1)

		if	(GPIO.input(door) == 0):
			f = open('/home/pi/caltivation/ctrl/temp_ctrl','w')
			f.write('1')
			f.close()
			print('heater disable')
		else: 
			print('door open , heater disable')
		
GPIO.output(air_heater, 0)
GPIO.output(water_heater, 0)
print('ctrl_exit...')
GPIO.cleanup()

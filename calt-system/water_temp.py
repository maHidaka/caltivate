##################
# use senser : LM35
#output voltage = [temperture(cel) * 10]mV
##################

import os

def readData():
	
	adData = open('/home/pi/caltivation/ctrl/ad1',"r")
	
	for val in adData:
		
		data = float(val) * 100 
		return data
	adData.close()

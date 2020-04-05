import os

def readData():
	
	adData = open('/home/pi/caltivation/ctrl/ad0',"r")
	
	for val in adData:
		
		data = float(val) * 4.928
		return data
	adData.close()

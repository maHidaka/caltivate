import spidev
import os

def read():
	dir_path = "/home/pi/caltivation/ctrl"

	Vref = 3.29
	ch0 = [0x06,0x00,0x00]
	ch1 = [0x06,0x40,0x00]
	ch2 = [0x06,0x80,0x00]
	ch3 = [0x06,0xc0,0x00]
	ch4 = [0x07,0x00,0x00]
	ch5 = [0x07,0x40,0x00]
	ch6 = [0x07,0x80,0x00]
	ch7 = [0x07,0xc0,0x00]
	 
	if not os.path.exists(dir_path):
		os.makedirs(dir_path)

	spi = spidev.SpiDev()
	spi.open(0,0) #bus 0,cs 0
	spi.max_speed_hz = 1000000 # 1MHz
	adc = spi.xfer2(ch0)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad0','w')
	f.write(val)
	f.close()

	adc = spi.xfer2(ch1)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad1','w')
	f.write(val)
	f.close()


	adc = spi.xfer2(ch2)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad2','w')
	f.write(val)
	f.close()

	adc = spi.xfer2(ch3)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad3','w')
	f.write(val)
	f.close()

	spi = spidev.SpiDev()
	spi.open(0,0) #bus 0,cs 0
	spi.max_speed_hz = 1000000 # 1MHz
	adc = spi.xfer2(ch4)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad4','w')
	f.write(val)
	f.close()

	adc = spi.xfer2(ch5)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad5','w')
	f.write(val)
	f.close()

	adc = spi.xfer2(ch6)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad6','w')
	f.write(val)
	f.close()

	adc = spi.xfer2(ch7)
	data = ((adc[1] & 0x0f) << 8) | adc[2]
	val = str(Vref*data/4095)
	f = open('/home/pi/caltivation/ctrl/ad7','w')
	f.write(val)
	f.close()


	spi.close()
	return 0

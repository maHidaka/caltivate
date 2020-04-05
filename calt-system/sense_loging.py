#coding: utf-8

import in_temp
import in_press
import in_hum
import out_temp
import out_press
import out_hum
import water_temp
import ph_val
import adc_read

import datetime
import os




dir_path = '/home/pi/caltivation/log'

now = datetime.datetime.now()
filename = now.strftime('%Y%m%d')
label = now.strftime('%H:%M')
date = now.strftime('%Y/%m/%d %H:%M')

adc_read.read()

csv_in_t = in_temp.readData()
csv_in_p = in_press.readData()
csv_in_h = in_hum.readData()
csv_out_t = out_temp.readData()
csv_out_p = out_press.readData()
csv_out_h = out_hum.readData()
csv_water_t = water_temp.readData()
csv_ph_val = ph_val.readData()

if not os.path.exists('/home/pi/caltivation/log'):
    os.makedirs('/home/pi/caltivation/log')

f = open('/home/pi/caltivation/log/'+filename+'_in_t.csv','a')
f.write("'"+date+"',"+csv_in_t+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_in_p.csv','a')
f.write("'"+date+"',"+csv_in_p+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_in_h.csv','a')
f.write("'"+date+"',"+csv_in_h+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_out_t.csv','a')
f.write("'"+date+"',"+csv_out_t+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_out_p.csv','a')
f.write("'"+date+"',"+csv_out_p+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_out_h.csv','a')
f.write("'"+date+"',"+csv_out_h+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_water_t.csv','a')
f.write("'"+date+"',"+str(csv_water_t)+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_ph_val.csv','a')
f.write("'"+date+"',"+str(csv_ph_val)+"\n")
f.close()

f = open('/home/pi/caltivation/log/'+filename+'_temperature.csv','a')
f.write("'"+date+"',"+csv_in_t+","+csv_out_t+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_pressure.csv','a')
f.write("'"+date+"',"+csv_in_p+","+csv_out_p+"\n")
f.close()
f = open('/home/pi/caltivation/log/'+filename+'_humidity.csv','a')
f.write("'"+date+"',"+csv_in_h+","+csv_out_h+"\n")
f.close()



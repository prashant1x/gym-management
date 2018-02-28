import time
import math
import http
from rfid import get_rfid_with_wait
from ir_sensor import get_ir_data
import config
import datetime
import json

reps_threshold = 0
set_threshold = 0

def init():
	
	global reps_threshold
	global set_threshold
	
	set_threshold, reps_threshold = http.get('ConfigController/get')

def main_loop():

	global reps_threshold
	global set_threshold
	
	rfid = get_rfid_with_wait()
	user = {'rfid': rfid, 'set': []}
	current_set = {'startTime': datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"), 'reps': 0, 'endTime':''}
	set_timer_start = time.time()
	rep_timer_start = time.time()

	while True:
		if get_ir_data(rep_timer_start, reps_threshold):
			current_set['reps'] = int(current_set['reps']) + 1
		else:
			if current_set['reps'] > 0:
				current_set['endTime'] = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
				user['set'].append(current_set)
			current_set = {'startTime': datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"), 'reps': 0, 'endTime':''}
		rep_timer_start = time.time()
		time.sleep(0.8)
		if math.floor(time.time() - set_timer_start) >= set_threshold:
			if current_set['reps'] > 0:
				current_set['endTime'] = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
				user['set'].append(current_set)
			http.post([('data',json.dumps(user))], 'SetController/add')
			break

if __name__ == '__main__':
	init()
	while True:
		main_loop()

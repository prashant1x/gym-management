import RPi.GPIO as GPIO
import time
import math

def init():
	GPIO.setmode(GPIO.BCM)
	GPIO.setup(14, GPIO.IN)

def get_ir_data(rep_timer_start, reps_threshold):
	while True:
		if GPIO.input(14) == 0:
			return True
		elif math.floor(time.time() - rep_timer_start) >= reps_threshold:
			return False

init()
import serial

ser = None

def init():
	global ser
	ser = serial.Serial('/dev/ttyS0')
	ser.baudrate = 9600


def get_rfid_with_wait():
	global ser
	rfid = ser.read(12)
	return rfid

init()
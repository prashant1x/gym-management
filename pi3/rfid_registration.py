import http
from rfid import get_rfid_with_wait

def init():
    while True:
        inp = raw_input('1. Register RFID\n0. exit\n')
        if inp == 0 or inp == '0':
            break
        inp = raw_input('Enter RFID card number: ')
        print('Place RFID card on reader...')
        RFID = get_rfid_with_wait()
        print http.post([("card_id",inp), ("id",RFID)], "RFIDController/add")


if __name__ == '__main__':
	init()
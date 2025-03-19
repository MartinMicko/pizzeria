import serial
import requests
ser = serial.Serial('COM9', 9600)  
def anjelo():
    print(ser.name)
    x = 0
    while x != b'Pizza Done':         
        x = ser.readline()
        x = x.replace(b'\n', b'').replace(b'\r', b'') 
        print(x)   
    x = requests.get(url="http://i525769.hera.fhict.nl/update.php?action=update")
    print(x)

while True:
    try:
        anjelo()
    except KeyboardInterrupt:
        print ('shutdown')
        ser.close()
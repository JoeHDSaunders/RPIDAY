from tkinter import *
import time
import sys
import json
from urllib.request import urlopen
import datetime
import winsound
import xml.etree.ElementTree as ET

alarmFrequency = 2500
bleepInterval = 1000

userCityID="2634739"
deltaTime = 0
apiKey = "b1b15e88fa797225412429c1c50c122a"
startWeatherURL = "http://api.openweathermap.org/data/2.5/weather?id=" + userCityID + "&appid=" + apiKey
ALARMTIMES = {"MON" : ["16:30:00"],
"TUE" : ["16:30:00"],
"WED" : ["16:30:00"],
"THU" : ["16:30:00"],
"FRI" : ["16:30:00"],
"SAT" : ["16:30:00"],
"SUN" : ["16:30:00"]}
alarmTimeDelay = 10
#DEFALT SETTINGS AT 0000000000 JUST CHANGE BELOW
UID = "Htsgst5s6s";
userDataURL = "http://192.168.1.102/getUserPrefrances.php?uid=" + UID

def getUserData():
	response = urlopen(userDataURL)
	data = response.read().decode('utf-8')
	tree  = ET.fromstring(data)
	if(tree.find("error").text != "200"):
		print("Error Loading Weather : " + tree.find("error").text)
	else:
		print(tree[0][0].text)

def checkAlarm():
	#if(ALARMTIMES[(time.strftime("%a").upper())] == ):
	today = time.strftime("%a").upper()
	#nextAlarm = []
	for alarm in ALARMTIMES[today]:
		alarmTimeString = time.strftime("%d/%m/%Y ") + alarm
		alarmTimeInSeconds = time.mktime(datetime.datetime.strptime(alarmTimeString, "%d/%m/%Y %H:%M:%S").timetuple())
		if (alarmTimeInSeconds-(alarmTimeDelay/2)) <= time.time() <= (alarmTimeInSeconds+(alarmTimeDelay/2)):
			winsound.Beep(alarmFrequency, bleepInterval)

def googleCalender():
	pass
			
def getWeather(root, weatherSTRVAR):
	global deltaTime
	updateDeltaTime = 1800
	
	if(deltaTime>=updateDeltaTime):
		response = urlopen(startWeatherURL)
		data = json.loads(response.read().decode('utf-8'))
		weatherSTRVAR = StringVar()
		if(data["cod"] != 200):
			print("Error Loading Weather : " + data["cod"])
			weatherSTRVAR.set("Error Loading Weather : " + data["cod"])
		else:
			weatherSTRVAR.set(data["weather"][0]["main"])
		deltaTime = 0
	else:
		deltaTime += 1
		print(deltaTime)

def Update(root, timeSTRVAR, weatherSTRVAR):
	currentTimeStr = str(time.strftime("%a %d %H:%M:%S"))
	timeSTRVAR.set(currentTimeStr)
	currentWeather = "Unknown"
	getWeather(root, weatherSTRVAR)
	print(currentTimeStr)
	checkAlarm()
	root.after(1000, Update, root, timeSTRVAR, weatherSTRVAR)
	
	
def __init__():
	root = Tk()
	currentTimeSTRVAR = StringVar()
	currentTimeSTRVAR.set(str(time.strftime("%a")))
	clockWidget = Label(root, textvariable =currentTimeSTRVAR)
	clockWidget.pack()
	
	response = urlopen(startWeatherURL)
	data = json.loads(response.read().decode('utf-8'))
	weatherSTRVAR = StringVar()
	if(data["cod"] != 200):
		print("Error Loading Weather : " + data["cod"])
		weatherSTRVAR.set("Error Loading Weather : " + data["cod"])
	else:
		weatherSTRVAR.set(data["weather"][0]["main"])
	weatherWidget = Label(root, textvariable =weatherSTRVAR)
	weatherWidget.pack()
	Update(root, currentTimeSTRVAR, weatherSTRVAR)
	root.mainloop()

getUserData()
__init__()
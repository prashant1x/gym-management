import ConfigParser

configParser = ConfigParser.RawConfigParser()
configParser.read('app.cfg')

def get(section, key):
	global configParser
	return configParser.get(section, key)
import urllib2
import urllib
import config

def post(query_args, uri):
	url = config.get('server_url_section', 'POST') + uri
	data = urllib.urlencode(query_args)
	request = urllib2.Request(url, data)
	return urllib2.urlopen(request).read()

def get(uri):
	url = config.get('server_url_section', 'GET') + uri
	return tuple(map(int, urllib2.urlopen(url).read().split(',')))
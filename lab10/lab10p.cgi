#!/usr/bin/python3

import cgi

form = cgi.FieldStorage()

city = form.getvalue('city').upper()
province = form.getvalue('province')
country = form.getvalue('country').upper()
picture_url = form.getvalue('picture')

print("Content-type: text/html\n")
print('<html>')
print('<head><title>City Information (Python)</title></head>')
print('<body>')
print(f"<div style='text-align: center; background-color: yellow; color: blue; font-size: 36px;'>{city}, {country}</div>")
print(f"<div style='border: 10px solid red; padding: 10px;'><img src='{picture_url}' style='width: 80%;' alt='City Picture'></div>")
print('</body>')
print('</html>')

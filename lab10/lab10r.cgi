#!/usr/bin/ruby

require 'cgi'

cgi = CGI.new

city = cgi.params['city'].first.capitalize
province = cgi.params['province'].first.capitalize
country = cgi.params['country'].first.capitalize
picture_url = cgi.params['picture'].first

puts "Content-type: text/html\n\n"
puts '<html>'
puts '<head><title>City Information (Ruby)</title></head>'
puts '<body>'
puts "<div style='text-align: center; background-color: yellow; color: blue; font-size: 36px;'>#{city}, #{country}</div>"
puts "<img src='#{picture_url}' style='width: 100%;' alt='City Picture'>"
puts '</body>'
puts '</html>'

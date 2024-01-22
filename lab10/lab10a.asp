<%
' Function to generate a random background color
Function RandomColor()
    Dim colors
    colors = Array("FF5733", "33FF57", "5733FF", "FFFF33", "33FFFF", "FF33FF")
    Randomize
    RandomColor = colors(Int(Rnd() * 6))
End Function

' Function to get the current date and time in a user-friendly format
Function CurrentDateTime()
    Dim dt
    dt = Now()
    dt = DateAdd("h", 1, dt) ' Add 1 hour to the current date and time
    CurrentDateTime = dt
End Function

' Check if a background color is provided in the query string
If Request.QueryString("color") <> "" Then
    bgColor = Request.QueryString("color")
Else
    bgColor = RandomColor()
End If

' Check if a cookie for the last visit exists
If Request.Cookies("LastVisit") <> "" Then
    lastVisit = Request.Cookies("LastVisit")
    lastVisit = DateAdd("h", 1, lastVisit) ' Add 1 hour to the last visit time
    firstVisit = False
Else
    lastVisit = ""
    firstVisit = True
End If

' Set a cookie for the current visit
Response.Cookies("LastVisit") = Now()

%>
<!DOCTYPE html>
<html>
<head>
    <title>Background Color Changer</title>
</head>
<body bgcolor="#<%=bgColor%>">
    <h1>Problem 1!</h1>
    <p>Background Color: <%=bgColor%></p>
    <p>Current Date and Time: <%=CurrentDateTime()%></p>
    <% If firstVisit Then %>
        <p>This is your first visit to this page.</p>
    <% Else %>
        <p>Your last visit was on: <%=lastVisit%></p>
    <% End If %>
</body>
</html>


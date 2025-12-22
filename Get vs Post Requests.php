<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get vs Post Requests</title>
</head>
<body>
    <h1>Login</h1>
    <form method="GET" action=""> //Get Requests used for searching and retrieving data form the server 
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" vlaue="Login">
    </form>
</body>
</html>



Get Requests: used for searching and retrieving data form the server 
              For retrieving data (read-only operations)
              Data sent via URL (query string)
              Limited by URL length (2048 characters)
              Less secure - data visible in URL and browser history
              Yes - repeated requests give same result
              repeated requests give same result
              Can be cached






    
    
    <h1>Login</h1>  
    <form method="POST" action=""> Post Requests used to send data to the server in a secure manner
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="submit" vlaue="Login">
    </form>


Post Requests:  used to send data to the server in a secure manner
                For sending data to be processed (create/update operations)
                No practical limits (server-defined)
                More secure - data hidden in body
                No - repeated requests may change data
                Not typically cached









REST API Context

· GET: Retrieve resources (GET /users)
· POST: Create resources (POST /users)
· PUT: Update resources (PUT /users/1)
· DELETE: Remove resources (DELETE /users/1)







              

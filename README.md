# EndBird's Twitter Explorer Application
* Note: make sure to create Database to get the app working.  It uses postgresql database. check out launchDB.ddl.
## Purpose of this Application
* Learn to utilize PHP, javascript, and html together.  
* To get hands-on experience creating a psql database, accessing and manipulating its data using SQL through PHP.
* Learn to create accounts and authenticate users. 
* To create a useful application that connects the user with the outside world, across borders, cultures, and experiences. 

## Premise of Service
* Welcome to the Twitter Sea, an ocean of tweets waiting for you to discover. Explore, learn, and connect with the world around you. 
* When looking up a search query, my service creates a word cloud based on the return results from the search query.  

## The Interface

	The interface of the application consists of the welcome page, the sign up page, edit profile page, and the service app page. The welcome page is the first page everyone would see when visiting -- the introduction page -- which is the welcome.html file .  From here you can go to the sign up page or use the log in bar of the welcome page and head straight to the service app page. The sign up page lets visitors make new accounts, and is the SignUp.html file.  The service app page is the service provided to those who sign up for an account, which is the main.html file. From main.html, you can edit your profile, change username, account, etc.. through clicking 'edit your profile', which leads you to editProfile.html.

## How the app works internally

### SignUp.html and welcome.html aspects:

#### The sign in and making account features

	Behind the scene there is a psql database that stores a table that contains the account usernames and passwords of anyone who is registered.  
		If someone tries to sign in, the my app uses piratelogin.php to check if the account given is in the database.  If not then
	welcome.html will redirect to block.html, which tells visitor that he does not have permission.  If yes, then it will give a nod to the welcome page and that page will redirect to the main page, main.html.  
		If someone does a sign up, the the welcome.html page will redirect you to the SignUp.html page to make an account.  When
	creating an account, SignUp.php will check if username is taken.  If it is then SignUp.html will say "account name taken". If not then SignUp.php will create a new table entry in the database to remember the new account. The visitor can now use it to log in. The password is hashed for security.
		User can upload a profile picture if the wish when creating an account, which is then stored in database as a data url using
	storeImg.php. 

### main.html aspects:
#### Word Cloud Creation

		When someone types in a search query and press search, the main.html sends a GET request to searchtwitter.php with the search
	query in the request.  searchtwitter.php would do oauth authentication with twitter to show security clearance, and then ask twitter to return search results of the query.  With the returned results, count the frequency of each word in the result and put data in array of (word, frequency).  Return this array in JSON format to main.html, which then uses jQCloud, a service made by a team on github (thanks!), to create a word cloud based on frequency of words.  The biggest words in word cloud imply higher frequencies.  

#### Sharing a Cloud to the Public
	
		If user wants to share a word cloud that is created, click the share button and main.html will send a POST request to
	savecloud.php.  savecloud.php will take the JSON string representation of the word cloud given to it and put it up on the database with the date of its creation. 

#### Liking a word cloud
	
		If user likes a word cloud posted, then user can like the cloud and the the number of likes that the cloud has will be 
	incremented in its respective database entry. This is done by main.html sending a POST request to addLike.php to modify database. 

#### Sifting through the collection of public word clouds
		
		On loading the main.html, send a GET request to loadClouds.php to get the up to five clouds in the database entry.  When user
	clicks "next", main.html checks if the next cloud has been loaded already into the computer. If yes, then main.html would simply show it, so no need for online request.  If no, then main.html will send a GET request to loadClouds.php.  The same reasoning applies for when user clicks "back".  

#### Picture in top right corner
		If user has a profile picture, then that picture will show in top right corner of the screen. The picture comes from
    loadProfilePic.php.

### editProfile.html aspects:
        If user wishes to change username or password, user must type information in twice and there will be an async checking to see
    if information is the same in both cases. 
        To update profile picture, user uploads a new picture or a url of a picture online. 
        When user is satisfied, click on change profile button which will utilize changeAccount.php to change account information in 
    database and change profile picture in storeImg.php. 


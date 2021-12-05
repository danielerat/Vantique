# Introduction

This is simply a chat Application using The Best Practices in PHP

Project Preview 
----------------

>Landing Page (Home page)
<img src="ReadMeDoc/home1.png " width="750" title="Cart">
<img src="ReadMeDoc/home2.png " width="750" title="Cart">
	
>Product Preview 
<img src="ReadMeDoc/pv.png " width="750" title="Cart">

>Category Preview 
<img src="ReadMeDoc/ctg.png " width="750" title="Cart">



>Product Listing 
<img src="ReadMeDoc/pl.png " width="750" title="Cart">
	

>User Cart 
<img src="ReadMeDoc/cart.png " width="750" title="Cart">
<img src="ReadMeDoc/8.png " width="750" title="Cart">
	s


>Admin Dashboard 
<img src="ReadMeDoc/10.png " width="750" title="Dashboard">


>Checkout Page 
<img src="ReadMeDoc/checout.png " width="750" title="Checkout">


# API Documentation
## Use Cases

There are many reasons to use an API. 
Down Here , there are quire Few things You Might Want to do with This Project API:

```http
GET :: USER BY USERNAME : chatPrototype/vantique/API.php?api_name=get_user&username=username
```

```http
GET :: ALL Products vantique/API.php?api_name=get_products&category=--all
```






## Responses

#### SUCCESS RESPONSES
Many API endpoints return the JSON representation of the resources created or edited : 

```javascript
{
    unique_id	"2051224492162685558060f7d89cbcb6f"
    first_name	"Daniel"
    last_name	"Gisa Ilunga"
    username	"danielerat"
    email	    "davidodo2015@gmail.com"
    phone	    "078....."
}
```

#### FAILED RESPONSES
However, if an invalid request is submitted, or some other error occurs, A JSON response in the following format Will be returned

```javascript
{
    "status" => 'int',
    "success" => 'failed',
    "message" => "ERROR DESCRIBING THE REQUEST"
}
```


The `message` attribute contains a message commonly used to indicate errors or

The `success` attribute describes if the transaction was successful or not.

The `status` attribute describes if the transaction was successful or not.



## Status Codes

 Codes Describing the status errors which will be returned to you , 

| Status Code | Description |
| :--- | :--- |
| 200 | `OK` |
| 201 | `CREATED` |
| 400 | `BAD REQUEST` |
| 404 | `NOT FOUND` |
| 500 | `INTERNAL SERVER ERROR` |



## Setup/installation
$ git clone https://github.com/danielerat/Vantique.git <br>
$ cd Vantique <br>
$ Import The Database
$ Change To your Database Credentials (username & password) private/db_credentials.php
$ Run the Project 



## Author
Username: danielerat</br>
Names: Ilunga Gisa Daniel</br>
email:danielilunga35@gmail.com

## License
MIT



https://www.postman.com/danielerat/workspace/chatapplicationurapi/collection/17257182-7fadd075-5f3f-4f10-befe-f70569b48da5


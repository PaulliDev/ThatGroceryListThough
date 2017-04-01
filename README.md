# Grocery list

Hey, hello Peter and Martijn, here is little implementation summary for you :)
I decided to go with Vue('cuz you mentioned it in skype call) and of course Laravel.
Here on github I created two not so usual branches, Master is just website with VUE implementation, that don't work completly without server but is there for informative purposes. Second is Called Laravel and here you can find my whole Laravel Project.

First here is how it looks:

![Grocery App](/graphics/final.png)

## How things work

App goes like this:
1. User open the main page (route '/') app loads
1. If user add something to the list ajax call is made (via axios) which sends data of list variable to the server, where they're encoded as json and store in simple mysql table, basically it's just ID and LIST(didn't want to overcomplicate with fk and such...), same goes when user change state or edit item in the list. I just maybe want to mention how I implemented editing of items in the list they're just input fields with vue v-model.lazy value. And on whole list vue watch set up. To keep it in sync with database if something changed.
1. If user is happy with his list he can click up right share icon to get URL to his list.

Second scenario is that user have already saved list and want to load it up with url then it goes like this:
1. User open main page with id, routing fetch appropriate data from databse and set different page layout.
1. Page layout include self executing function that create list variable and store it in position to display list for user.

## Possible pitfalls of implementation:

* First, every list is inserted in database with unique ID, I decided to go with standard autoincrement. But that can lead data exposing, someone can go and try every ID from 1-infinity and see every list user saved. I decided that I take that risk because I don't store any private information, but in real implementation I would not consider this as an option and goes with php uniqid function.
* Second, everone who visit website and add at least one item create record in database, I would consider deleting every record older than 2day or so.
* Third, if someone create list and delete every record list is still saved(but second point will get rid of this too).

## I know...
Yes, guys, I'm sorry, I know it took me more time then I first estimated. To be frank It took me circa 2 days. I'm not going to make excuses It is how it is... And thanks I really felt in love Vue and Laravel, make things super simple. Love it.

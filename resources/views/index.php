<!DOCTYPE html>
<html>
<head>
	<title>BeepRoger-Grocery List</title>
	<link href="css/app.css" rel="stylesheet"/>
</head>
<body>

<div id='grocery-list'>
	<div id='info-part'>
		<button id="shareButton" @click="copyURLtoClip"></button>
		<div id='left-info-part' class="nFontSize"><p>Grocery list</p></div>
		<div id='right-info-part'>
			<div id='list-info-togo'> <p class="a-right">{{togo}}</p> <p class="smaller">ToGo</p> </div>
			<div id='list-info-done'> <p class="a-right">{{done}}</p> <p class="smaller">Done</p> </div>
		</div>
	</div>
	<div id='list-part'>

		<ul id='list-entries' class="fDenseR">
			<li is="grocery-list-entry" v-for="(entry, i) in groceryList" :i="i" :key="entry.id" :entry="entry" :imgsrc="whichSrc(entry.done)" @switch="switchState(entry)" @delete="deleteEntry(entry)"></li>
		</ul>
		
		<footer>
			<p class="smaller fDenseR">Total items {{gListLength}}</p>
			<button id="addButton" @click="addItemToGrocery"></button>
			<input class="f-right" v-model="agitem"  @keyup.enter="addItemToGrocery" maxlength="30" :placeholder="addPlaceholder">
		</footer>

	</div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<script src="js/app.js"></script>
</body>
</html>
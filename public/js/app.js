var groceryListEntry = 	{
	props: ['entry', 'imgsrc'],
	template: `
		<li class="list-entry" :class="{checked : entry.done}">
			<img class='checkImg' @click="$emit('switch')" :src='imgsrc'/>
			<img class='deleteImg' src='graphics/bin.png' @click="$emit('delete')" />
			<input v-model.lazy="entry.item" v-bind:test="entry.item" maxlength="30" />
		</li>
	`
};

var lp = new Vue({
	el: '#list-part',
	data: {
		id: 0,
		agitem: '',
		addPlaceholder: 'Name item to add.',
		gListLength: 0,
		listId: undefined,
		groceryList: []
	},
	methods:{
		switchState: function(entry){
			entry.done = !entry.done;
			this.updateSizes();
		},
		deleteEntry: function(entry){
			var index = this.groceryList.indexOf(entry);
			if( index !== -1){
				this.groceryList.splice(index, 1);
			}
			this.updateSizes();
		},
		whichSrc: function(done){
			if(done){
				return 'graphics/done.png'
			}else{
				return 'graphics/togo.png'
			}
		},
		addItemToGrocery: function(){
			if(this.agitem === ''){
				this.addPlaceholder = 'Write something here.';
			}else if(this.groceryList.length < 100){
				this.groceryList.push({id: this.id, item: this.agitem, done: false});
				this.id++;
				this.agitem = '';
				this.addPlaceholder = 'Name item to add.';
				this.updateSizes();
			}else{
				this.agitem = '';
				this.addPlaceholder = 'Too much stuff.';
			}
		},
		updateSizes: function(){
			this.gListLength = this.groceryList.length;
			var done = 0, togo = 0;
			this.groceryList.forEach(function(item){
				if(item.done === true){
					done++;
				}else{
					togo++;
				}
			});
			rip.togo = togo;
			rip.done = done;
		},
		setListId: function(response){
			this.listId = response['Id'];
		},
		copyURLtoClip: function(){
			if(typeof this.listId === "undefined")
				window.alert("Please Create list first.");
			else
				window.prompt("Copy to clipboard: Ctrl+C, Enter", '/' + this.listId);
		}
	},
	components: {
		'grocery-list-entry': groceryListEntry
	},
	watch:{
		groceryList : {
			handler: function(val, oldval){
				if(typeof this.listId === "undefined"){
					var r = axios.post('/grocery/public/init-list', {
						groceryList: this.groceryList
						})
						.then((response) => {
							this.setListId(response.data)
						});
				}else{
					axios.post('/grocery/public/update-list', {
						listId: this.listId,
						groceryList: this.groceryList
					});
				}
			},
			deep: true
		}
	}
});

var rip = new Vue({
	el: '#info-part',
	data: {
		togo: 0,
		done: 0
	},
	methods: {
		copyURLtoClip: function(){
			if(typeof lp.listId === "undefined")
				window.alert("Please Create list first.");
			else
				window.prompt("Copy to clipboard: Ctrl+C, Enter", '/' + lp.listId);
		}
	}
});

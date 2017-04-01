@extends ('layouts.master')


@section ('JavaScriptFile')
	<script>
		// Function to execute when list is loaded from database
		(function (){
			var initId = {!! ($id) !!};
			var initValue = {!! ($list) !!};

			if(typeof initValue !== 'undefined' && typeof initId !== 'undefined'){
				var json = JSON.parse(initValue[0].list);
				initValue = [];
				json.forEach(function(item){
					var o = {'id':item.id, 'item':item.item, 'done':item.done};
					initValue.push(o);
				});
				lp.listId = initId;
				lp.groceryList = initValue;
				lp.updateSizes();
			}
		})();
	</script>
@endsection
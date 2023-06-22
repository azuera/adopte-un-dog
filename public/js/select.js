document.querySelectorAll('.tom-select').forEach((el)=>{
	let settings = {
		plugins: ['remove_button']
	};
	new TomSelect(el,settings);
});
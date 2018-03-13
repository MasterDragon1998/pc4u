
window.onload = function(){
	modal.init();
}

var modal = new function Modal(){
	this.ele = null;

	this.init = function(){
		this.ele = document.getElementById("modal");
		this.ele.setAttribute("style","position:absolute;top:0px;left:0px;width:100%;height:100%;z-index:1;background-color:rgba(20,20,20,0.4);display:none;");
		this.ele.addEventListener("click",function(e){
			if(e.target==document.getElementById("modal")){
				modal.close();
			}
		});
	}
	this.open = function(obj = null){
		this.ele.style.display = "block";
		if(obj=="registerPanel"){
			document.getElementsByClassName("registerPanel")[0].style.display = "block";
		}
	}
	this.close = function(){
		this.ele.style.display = "none";
	}
}
///index.html
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
if(count==0)document.getElementById('noitem').innerHTML='<img src="img/noitem.svg"><h3>Your cart is empty.</h3><h4>Add some delicious food available on our menu to checkout.</h4>';
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
function clicke(clicked_id){
  count++;
  var l=clicked_id.parentNode.previousElementSibling.textContent;
  var j = document.createElement('div');
  j.setAttribute("id", "a"+clicked_id.parentNode.id);
  j.setAttribute("class", "cartdiv");
  j.innerHTML='<div class="cartdivin">'+l.substring(0,l.length-5)+'</div><div class="cartdivinb"><span>Qty: 1</span><span class="cartpr">'+l.substring(l.length-5)+'</span></div>';
  var addressContainer = document.getElementById("mySidenav");
  addressContainer.appendChild(j);
  clicked_id.parentNode.innerHTML='<button class="added" onclick="decr(this)">-</button><span id="qty" class="qty">1</span><button class="added" onclick="inc(this)">+</button>';
  var aa=document.querySelectorAll(".cartpr");
  var sum=0;
  for(var i=0;i<aa.length;i++)
  {
    var temp=aa[i].textContent;
    sum+=parseInt(temp.substring(temp.length-3));
  }
  document.getElementsByClassName("place")[0].innerHTML="Place order &#8377 "+sum;
  
  if(count==1){
    document.getElementById('items').innerHTML=count+" item";
  document.getElementById('noitem').innerHTML="";
  document.getElementsByClassName("place")[0].setAttribute("href","src/checkout.html");
  document.getElementsByClassName("place")[0].setAttribute("onclick","sendval()");}
  else document.getElementById('items').innerHTML=count+" items";
  //console.log(j.outerHTML);
}
function inc(clicked_id){
var val=parseInt(clicked_id.previousElementSibling.textContent);  
if(val<5){
  count++;
  var l=clicked_id.parentNode.previousElementSibling.lastChild.textContent;
  var l=parseInt(l.substring(l.length-3));
  var a="a"+clicked_id.parentNode.id;
  val++;
  clicked_id.previousElementSibling.innerHTML = val;
  document.getElementById(a).lastChild.firstChild.innerHTML="Qty: "+val;
  document.getElementById(a).lastChild.lastChild.innerHTML="&#8377 "+l*val;

  var aa=document.querySelectorAll(".cartpr");
  var sum=0;
  for(var i=0;i<aa.length;i++)
  {
    var temp=aa[i].textContent;
    sum+=parseInt(temp.substring(temp.length-3));
  }
  document.getElementsByClassName("place")[0].innerHTML="Place order &#8377 "+sum;
  document.getElementById('items').innerHTML=count+" items";
}
console.log(count);
}
function decr(clicked_id){
count--;
  var val=parseInt(clicked_id.nextElementSibling.textContent);
  var a="a"+clicked_id.parentNode.id;
  if(val==1){
    document.getElementById('mySidenav').removeChild(document.getElementById(a));
    clicked_id.parentNode.innerHTML='<button class="add" onclick="clicke(this)">Add</button>';
  
}
  if(val>1){
  var l=clicked_id.parentNode.previousElementSibling.lastChild.textContent;
  var l=parseInt(l.substring(l.length-3));
  val--;
  clicked_id.nextElementSibling.innerHTML = val;
  document.getElementById(a).lastChild.firstChild.innerHTML="Qty: "+val;
  document.getElementById(a).lastChild.lastChild.innerHTML="&#8377 "+l*val;}

  var aa=document.querySelectorAll(".cartpr");
  var sum=0;
  for(var i=0;i<aa.length;i++)
  {
    var temp=aa[i].textContent;
    sum+=parseInt(temp.substring(temp.length-3));
  }
  document.getElementsByClassName("place")[0].innerHTML="Place order &#8377 "+sum;
  if(count==0){document.getElementById('items').innerHTML="";
  document.getElementsByClassName("place")[0].innerHTML="Browse Food"
  document.getElementsByClassName("place")[0].setAttribute("href","#rice");
  document.getElementsByClassName("place")[0].setAttribute("onclick","closeNav()");
  document.getElementById('noitem').innerHTML='<img src="img/noitem.svg"><h3>Your cart is empty.</h3><h4>Add some delicious food available on our menu to checkout.</h4>';}
  else if(count==1)document.getElementById('items').innerHTML=count+" item";
  else document.getElementById('items').innerHTML=count+" items";
}

function cart(){
var qty1=document.querySelectorAll('.qty');
var i;
for(i=0;i<qty1.length;i++){
var j = document.createElement('div');
j.innerHTML=qty1[i].textContent+qty[i].parentNode.previousElementSibling.textContent;
var addressContainer = document.getElementById("mySidenav");
addressContainer.appendChild(j);
}
}

function sendval1(){
var node=document.getElementById('mySidenav');
var local = localStorage.getItem("html");
if (local != null){
localStorage.removeItem("html");
}
localStorage.setItem("html", node.outerHTML);
}
function sendval() {
  localStorage.clear();
  var node = document.getElementsByClassName("cartdivin");
  var allfoods = "";
  var allamounts = "";
  for (var i = 0; i < node.length; i++) {
    var a = node[i].textContent;
    var b = node[i].nextSibling.firstChild.textContent;
    var c = node[i].nextSibling.lastChild.textContent;
    allfoods+=("#"+a.trim()+" x"+b[b.length-1]);
    var cless = parseInt(c.substring(c.length - 3));
    allamounts += ("#"+cless);
    localStorage.setItem(a + " x" + b[b.length - 1], c);
  }
  localStorage.setItem("allfoods",allfoods.substring(1));
  localStorage.setItem("allamounts",allamounts.substring(1));
  localStorage.setItem("footcount",""+node.length);
  var c = document.getElementsByClassName("place")[0].textContent;
  localStorage.setItem("total", c.substring(c.length - 6));
  console.log(localStorage);
}
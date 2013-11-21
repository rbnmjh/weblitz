var tickercontents=new Array()
tickercontents[0]='Welcome to Nepal SBI Bank Ltd.'
tickercontents[1]='NEPAL SBI BANK LTD. A joint venture of SBI Bank.'


var tickdelay=3000//delay btw messages
var highlightspeed=1 //10 pixels at a time.

////Do not edit pass this line////////////////

var currentmessage=0
var clipwidth=0

function changetickercontent(){
crosstick.style.clip="rect(0px 0px auto 0px)"
crosstick.innerHTML=tickercontents[currentmessage]
highlightmsg()
}

function highlightmsg(){
var msgwidth=crosstick.offsetWidth
if (clipwidth<msgwidth){
clipwidth+=highlightspeed
crosstick.style.clip="rect(0px "+clipwidth+"px auto 0px)"
beginclip=setTimeout("highlightmsg()",20)
}
else{
clipwidth=0
clearTimeout(beginclip)
if (currentmessage==tickercontents.length-1) currentmessage=0
else currentmessage++
setTimeout("changetickercontent()",tickdelay)
}
}

function start_ticking(){
crosstick=document.getElementById? document.getElementById("highlighter") : document.all.highlighter
crosstickParent=crosstick.parentNode? crosstick.parentNode : crosstick.parentElement
if (parseInt(crosstick.offsetHeight)>0)
crosstickParent.style.height=crosstick.offsetHeight+'px'
else
setTimeout("crosstickParent.style.height=crosstick.offsetHeight+'px'",100) //delay for Mozilla's sake
changetickercontent()
}

if (document.all || document.getElementById)
window.onload=start_ticking
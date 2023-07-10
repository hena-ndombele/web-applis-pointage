
const express=require('express');
const socketIO=require('socket.io');
const http=require('http')
const port=process.env.PORT||5000
var app=express();
var identifiant;
let notifications=[];
let server = http.createServer(app);
var io=socketIO(server);
let donnee;
let verificationNbr=0;
let data={};
let cle=0;
let cleTab=[];
   
if(typeof notifications.id=="undefined"){
    console.log("pas defini====================")
    notifications.id=[];
    }

// make connection with user from server side
io.on('connection', (socket)=>{

    console.log('New user connected', socket.id);

//emit message from server to user

    socket.on("joinRoom", (id)=>{
        socket.join("room-"+id);
        socket.join("room-all");
        identifiant=id;
        console.log(cleTab);
        console.log(notifications.id);
        let key=3;
        while(cleTab.length>0){
            let key=cleTab.pop();
            donnee=notifications.id.cle;
            
            donnee=JSON.stringify(donnee);
            setTimeout(function() {
                io.sockets.in("room-"+identifiant).emit('receive', donnee)
              }, 500);
            key--;
        }
        console.log(`Id ${id} vient de rejoindre le Room`)
    })
     //_____________________________________________________________

     app.use(express.json());
     app.use(express.urlencoded({ extended: false }));
    /* 'form_params' => [
        'user_id' => "demande->user_id",
        'debut' => $demande->debut,
        'fin' =>$demande->fin,
        'status'=>$demande->status,
    ]*/
     
     app.post('/reception', (req, res) => {

   
       let id = req.body.user_id;
       cle=req.body.id;
       
       let debut=req.body.debut;
       let fin=req.body.fin;
       let status=req.body.status;
       let motif =req.body.motif
       data.id=id;  
       data.debut=debut;
       data.fin=fin;
       data.status=status;
       data.status=motif;
       let jsonData=JSON.stringify(data);
/*
       if(verificationNbr==501 ){
        console.log("^^^^^^"+verificationNbr);
        notifications.id['$cle']=data;
        console.log(notifications.id);
       }*/
      
       io.sockets.in("room-"+req.body.user_id).emit('receive', jsonData);
     

        cleTab.push("cle");
        notifications.id.cle=data;
    
        console.log('####'+cleTab)
       
       res.send('Données reçues avec succès !');
     });
     

 
     //_________________________________________________________

// listen for message from user
socket.on("confirmation", (code)=>{
          
    let jsonCode=JSON.parse(code);
    verificationNbr=jsonCode.id;
  

        cleTab.pop();

   });


  
    socket.on('createMessage', (data)=>{
       // list.push(ID);
        //socket.emit('users',list);
        console.log('createMessage', data);
        io.sockets.in("room-"+data.id).emit('sendMessage', data.message);
    });

    socket.on('disconnect', ()=>{
        console.log('disconnected from user', socket.id);
    });



});


app.get("/", (req, res) => {
res.sendFile(__dirname + "/client-side.html");
});
app.listen(3000, () => {
    console.log('Le serveur est en cours d\'exécution sur le port 5000');
  });

server.listen(port, ()=>{
    console.log("Server started!!", port)
});

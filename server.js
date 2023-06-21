
const express=require('express');
const socketIO=require('socket.io');
const http=require('http')
const port=process.env.PORT||5000
var app=express();
var identifiant;
let server = http.createServer(app);
var io=socketIO(server);

// make connection with user from server side
io.on('connection', (socket)=>{
    
    console.log('New user connected', socket.id);

//emit message from server to user

    socket.on("joinRoom", (id)=>{
        socket.join("room-"+id);
        socket.join("room-all");
        identifiant=id;
        console.log(`Id ${id} vient de rejoindre le Room`)
    })

// listen for message from user
    socket.on('createMessage', (data)=>{
       // list.push(ID);
        //socket.emit('users',list);
        console.log('createMessage', data);
        io.sockets.in("room-"+data.id).emit('sendMessage', data.message);
    });
    socket.on('sound', (data)=>{
        // list.push(ID);
         //socket.emit('users',list);
         console.log('createMessageSound', data);
         io.sockets.in("room-"+data.id).emit('receive', data.message);
     });



    // when server disconnects from user
    socket.on('disconnect', ()=>{
        console.log('disconnected from user', socket.id);
    });
    //_____________________________________________________________

app.use(express.json());
app.use(express.urlencoded({ extended: false }));

app.post('/reception', (req, res) => {
  const nom = req.body.nom;
  const email = req.body.email;
  const message = req.body.message;
  console.log(nom);

  // Traitez les données ici
  
  res.send('Données reçues avec succès !');
});

app.listen(8000, () => {
  console.log('Le serveur est en cours d\'exécution sur le port 5000');
});
//_________________________________________________________


});

app.get("/", (req, res) => {
res.sendFile(__dirname + "/client-side.html");
});

server.listen(port, ()=>{
    console.log("Server started!!", port)
});

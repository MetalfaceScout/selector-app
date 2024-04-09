import { Player } from "./team.js";

const POSITIONS = [
    "Commander",
    "Heavy",
    "Scout",
    "Ammo",
    "Medic"
]

let playerPool = [];
let boundPlayer;

async function fetchPlayerPool() {
    let data = await fetch("https://dev.metalface.me/api/players", {
    method: "GET",
    body: null,
    headers: {
        "Content-Type": "text/plain"
    }
    })

    setPlayers(await data.json());
}


async function main() {
    await fetchPlayerPool();
    bindButtons();
}

function setPlayers(players) {
    players.forEach(element => {
        const player = new Player(element);
        playerPool.push(player);
    });
}



function bindButtons() {
    //bind each player in the pool to a button on the side
    let sidebar = document.getElementById("choicePane");

    sidebar.innerHTML = "";

    for (let i = 0; i < playerPool.length; i++) {
        let newButton = document.createElement("button")
        newButton.id = playerPool[i].codename + "Button";
        newButton.innerText = playerPool[i].codename;
        newButton.addEventListener("click", (e) => {choicePaneButtonClicked(e)})
        sidebar.appendChild(newButton);
    }
}

function bindPlayerToStatsPane(player) {
    //Player Name
    let playername = document.getElementById("playerNameInput");
    playername.value = player.codename;
    boundPlayer = player;

    playername.addEventListener("change", (e) => {
        boundPlayer.setName(e.target.value);
    });

    //Avg Avg mvp
    let avgavgmvp = document.getElementById("avgAvgMVPInput");
    avgavgmvp.value = player["avg_mvp"];

    avgavgmvp.addEventListener("change", (e) => {
        boundPlayer.setAvgAvg(e.target.value);
    });

    for (let i = 0; i < POSITIONS.length; i++) {

        //AVG mvp
        let mvpfield = document.getElementById("avgMVP" + POSITIONS[i] + "Input");
        mvpfield.value = player[POSITIONS[i].toLowerCase() + "_avg_mvp"];

        //AVg acc
        let minfield = document.getElementById("avgAcc" + POSITIONS[i] + "Input");
        minfield.innerHTML = player[POSITIONS[i].toLowerCase() + "_avg_acc"]


        mvpfield.addEventListener("change", (e) => {
            const position = POSITIONS[i];
            let mvp = Number(e.target.value);
            if (isNaN(mvp)) {
                console.error("Field is not a number");
                return
            }
            boundPlayer.setAvgByPosition(position, mvp);
        });  
    }
}

function choicePaneButtonClicked(event) {
    let player = 0;
    playerPool.forEach((elt) => {
        if (elt.codename == event.target.firstChild.data) {
            player = elt;
        }
    });
    if (player == 0) {
        console.error("Could not find player: " + event.target.firstChild.data);
    }
    bindPlayerToStatsPane(player)
}

let saveButton = document.getElementById("savePlayerStatsButton");
saveButton.addEventListener("click", (e) => {
    boundPlayer.codename = document.getElementById("playerNameInput").value;

    console.log(JSON.stringify(boundPlayer));
    const url = "https://dev.metalface.me/api/players/" + boundPlayer.id;
    console.log(url)

    let result = fetch(url, {
        method: "PUT",
        body: JSON.stringify(boundPlayer),
        headers: {
            "Content-Type": "application/json"
        }
    });
    bindButtons();
});

/* let postTeamButton = document.getElementById("saveAll");
postTeamButton.addEventListener("click", (e) => {
}) */

let addPlayerButton = document.getElementById("addPlayerButton");
addPlayerButton.addEventListener("click", (e) => {
    const id = (playerPool[playerPool.length-1].id) + 1
    const playerObject = {
        "id": id,
        "codename":"New Player",
        "avg_mvp":10,
        "mvp_per_minute": 10,
        "avg_avg_acc":0,
        "games_won":0,
        "games_played":0,
        "hit_diff":0,
        "commander_avg_mvp":10,
        "commander_avg_acc":0,
        "heavy_avg_mvp":10,
        "heavy_avg_acc":0,
        "scout_avg_mvp":10,
        "scout_avg_acc":0,
        "ammo_avg_mvp":10,
        "ammo_avg_acc":0,
        "medic_avg_mvp":10,
        "medic_avg_acc":0
    }
    let new_player = new Player(playerObject);
    playerPool.push(new_player);
    //POST here
    let data = JSON.stringify(new_player);

    console.log(data);

    let result = fetch("https://dev.metalface.me/api/players/", {
    method: "POST",
    body: data,
    headers: {
        "Content-Type": "application/json"
    }})


    bindButtons();
})

let removePlayerButton = document.getElementById("removePlayerButton");
removePlayerButton.addEventListener("click", (e) => {

    let con = confirm("Are you sure you want to delete " + boundPlayer.codename + "?");
    if (!con) {
        return; 
    }

    for (let i = 0; i < playerPool.length; i++) {
        if (playerPool[i].codename == boundPlayer.codename) {
            playerPool.splice(i, 1);
        }
    }
    
    //make delete request
    let result = fetch("https://dev.metalface.me/api/players/" + boundPlayer.id, {
    method: "DELETE",
    body: null,
    headers: {
        "Content-Type": "application/json"
    }})

    boundPlayer = playerPool[0];
    document.getElementById("playerNameInput").value = "";
    bindButtons();
    bindPlayerToStatsPane(playerPool[0]);
})

window.onload = main();
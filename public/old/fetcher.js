

const CENTER_ID_LIST = {
    "stg" : 17,
    "llt" : 10,
}

let data;

async function getPlayerAverages(center_id) {
    const playerAverages =  await fetch(
        "https://lfstats.com/scorecards/getOverallAverages.json?" + 
        "gametype=social&" +
        "centerID=" + center_id + "&" + 
        "leagueID=0&" +
        "isComp=0&" + 
        "date=2024-02-07&" +
        "show_rounds=true&" +
        "show_finals=false&" +
        "show_subs=true"
    )
    return playerAverages;
} 

function dataReturned(dataJSON) {
    data = dataJSON;
    console.log(data);
}

class Fetcher {

    constructor (center_id) {
        let s = document.createElement("script");
        s.type = "text/javascript"
        s.src = "https://lfstats.com/scorecards/getOverallAverages.json?" + 
        "callback=dataReturned&" +
        "gametype=social&" +
        "centerID=" + CENTER_ID_LIST['stg'] + "&" + 
        "leagueID=0&" +
        "isComp=0&" + 
        "date=2024-02-07&" +
        "show_rounds=true&" +
        "show_finals=false&" +
        "show_subs=true";
        
        console.log(s);

        document.body.appendChild(s);
        
    }

    fetchFromCodename(codename) {
        
    }

    fetchFromPlayerId(player_id) {

    }

    /* setRanksFromPool(pool) {
        pool.forEach(element => {
            let avgMvp = this.getAvgMVPfromName(element.name);
            if (avgMvp != -1) {
                element.level = avgMvp;
            }
        });
    } */
}

export {Fetcher}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Team Selector</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')

    </head>
    <body class="antialiased dark:bg-zinc-800">
        <div class="p-4 m-4 flex  dark:bg-red-950">
            <h1 class="dark:text-white dark:bg-red-800 text-center my-auto text-2xl p-4 rounded-md" >Team Selector</h1>
            <div id="formatSelectDivider" class="grid m-auto">
                <label for="formatSelect" class="text-white text-2xl">Choose a team format:</label>
                <select class="text-white dark:bg-red-800" id="formatSelect">
                    <option value="6playerStandard">6 Players</option>
                    <option value="5playerStandard">5 Players</option>
                    <optgroup label="Specials">
                        <option value="7playerStandard">7 Players</option>
                        <option value="4playerScouts">4 Players, Scouts</option>
                        <option value="4playerQueenBee">4 Players, Queen Bee</option>
                    </optgroup>
                </select>
            </div>
            @if (Route::has('login'))
                <div class="p-4 m-4">
                    @auth
                        <a href="{{ url('/teams') }}" class="dark:text-white dark:bg-red-800 rounded-md my-auto p-4 m-1 text-2xl">Edit Teams</a>
                    @else
                        <a href=" {{ url('/login')}}" class="dark:text-white dark:bg-red-800 rounded-md my-auto p-4 m-1 text-2xl">Login</a>
                            @if (Route::has('register'))
                            <a href=" {{ url('/register')}}" class="dark:text-white dark:bg-red-800 rounded-md my-auto p-4 m-1 text-2xl">Register</a>
                            @endif
                    @endauth
                </div>
            @endif
        </div>
        <div id="mainSection" class="grid-cols-2">
            <div id="infoSection">
                <form id="addPlayerForm">
                    <div>
                        <label for="addPlayerNameInput">Add Player Name:</label>
                        <input type="text" id="addPlayerNameInput" name="addPlayerNameInput">
                    </div>
                    <div>
                        <label for="addPlayerRankInput">Add Player Rank from 1 - 10:</label>
                        <input type="text" id="addPlayerRankInput" name="addPlayerRankInput">
                    </div>
                    <input type="button" value="Add Player" id="addPlayerButton"></input>
		    <div>
			<label for="mvpCheckbox">Ignore lfstats MVP:</label>
		    	<input type="checkbox" id="mvpCheckbox" name="mvpCheckbox">
		    </div>	
                    <div>
                        <label for="removePlayerNameInput">Remove Player Name:</label>
                        <input type="text" id="removePlayerNameInput" name="removePlayerNameInput">
                    </div>
                    <input type="button" value="Remove Player" id="removePlayerButton"></input>
                </form>
                <div id="playerPool">
                    <ul id="playerPoolList">
                        <h2>Fetching average MVP, please wait...</h2>
                    </ul>
                </div>
                <button class="createTeamsButton" id="generateRandomTeamsButton">Generate Teams Randomly from Pool</button>
                <button class="createTeamsButton" id="matchmakeRandom">Matchmake Teams Random</button>
            </div>
            <div id="teamSection" >
                <div id="team1Header" class="teamHeader">
                    <h2 id="team1name" class="teamname">
                        Red Team
                    </h2>
                    <p id="team1stats"></p>
                </div>
                <div id="team2Header" class="teamHeader">
                    <h2 id="team2name" class="teamname">
                        Blue Team
                    </h2>
                    <p id="team2stats"></p>
                </div>
                <div id="team1" class="teamGrid">
                    
                </div>
                
                <div id="team2" class="teamGrid">
            
                </div>
                <button id="randomizeTeam1" class="randomizeTeamButton">Randomize Team 1</button>
                <button id="randomizeTeam2" class="randomizeTeamButton">Randomize Team 2</button>
            </div>
        </div>
    </body>
</html>
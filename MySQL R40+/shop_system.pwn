#include <a_samp>
#include <a_mysql>
#include <socket>
#include <sscanf2>
#include <CMD>

main() {}

#define    MYSQL_HOST        "localhost"
#define    MYSQL_USER        "root"
#define    MYSQL_DATABASE    "shop_system"
#define    MYSQL_PASSWORD    ""

forward OnAccountCheck(playerid);
forward OnAccountLoad(playerid);
forward OnAccountRegister(playerid);

enum {

	DIALOG_LOGIN,
	DIALOG_REGISTER
};

enum PlayersData {

	playerName[MAX_PLAYER_NAME],
	playerPass[129],
	playerMoney
};

new pInfo[MAX_PLAYERS][PlayersData], Socket:gSocket, MySQL:connectionHandle;

public OnGameModeInit() {

	mysql_log(ALL);
    connectionHandle = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_DATABASE, MYSQL_PASSWORD);
    if(mysql_errno() != 0) print("[MySQL] Failed Connection");
    else print("[MySQL] Successfully Connected");

	gSocket = socket_create(TCP);
	if(is_socket_valid(gSocket)) {

		socket_set_max_connections(gSocket, MAX_PLAYERS);
		socket_bind(gSocket, "127.0.0.1");
		socket_listen(gSocket, 7778);
	}

	mysql_tquery(connectionHandle, "CREATE TABLE IF NOT EXISTS `Users` (\
		`Username` varchar(25) NOT NULL,\
		`Password` varchar(129) NOT NULL,\
		`Money` int(11) NOT NULL default 0,\
		UNIQUE KEY `Username` (`Username`))");

	SetGameModeText("Socket 0.1b");
	return 1;
}

public OnGameModeExit() {

	mysql_close(connectionHandle);

	if(is_socket_valid(gSocket))
		socket_destroy(gSocket);
}

public OnPlayerConnect(playerid) {

	new query[100], pName[MAX_PLAYER_NAME];
	GetPlayerName(playerid, pName, sizeof pName);

    mysql_format(connectionHandle, query, sizeof(query), "SELECT `Password` FROM `Users` WHERE `Username` = '%e' LIMIT 1", pName);
    mysql_tquery(connectionHandle, query, "OnAccountCheck", "i", playerid);

    format(pInfo[playerid][playerName], MAX_PLAYER_NAME, pName);
    pInfo[playerid][playerMoney] = 0;

    TogglePlayerSpectating(playerid, true);
	return 1;
}

public OnPlayerDisconnect(playerid, reason) {

	new query[100];
	mysql_format(connectionHandle, query, sizeof(query), "UPDATE `Users` SET `Money` = %i WHERE `Username` = '%e'", GetPlayerMoney(playerid), pInfo[playerid][playerName]);
    mysql_tquery(connectionHandle, query);
	return 1;
}

public onSocketReceiveData(Socket:id, remote_clientid, data[], data_len) {

	new pName[MAX_PLAYER_NAME];
    if(data[0] == '1') { // IsPlayerConnected
  
  		new isConnected[10];
  		format(isConnected, sizeof isConnected, "Offline");

    	for(new i = 0, j = GetPlayerPoolSize(); i <= j; i++) {

    		if(!IsPlayerConnected(i)) continue;

    		GetPlayerName(i, pName, sizeof pName);
    		if(!strcmp(pName, data[2], false)) {

    			format(isConnected, sizeof isConnected, "Online");
    			break;
    		}
    	}
    	socket_sendto_remote_client(id, remote_clientid, isConnected);
    }
    else if(data[0] == '2') { // GetPlayerMoney

    	new getMoney[10];
  		format(getMoney, sizeof getMoney, "0");

    	for(new i = 0, j = GetPlayerPoolSize(); i <= j; i++) {

    		if(!IsPlayerConnected(i)) continue;

    		GetPlayerName(i, pName, sizeof pName);
    		if(!strcmp(pName, data[2], false)) {

    			format(getMoney, sizeof getMoney, "%i", GetPlayerMoney(i));
    			break;
    		}
    	}
    	socket_sendto_remote_client(id, remote_clientid, getMoney);
    }
    else if(data[0] == '3') { // CreateVehicle

    	// 3|PlayerName|VehicleID|VehiclePrice
    	new buyVehicle[15];
  		format(buyVehicle, sizeof buyVehicle, "FAILED");

  		new modelid, price, playername[MAX_PLAYER_NAME];
  		sscanf(data[2], "p<|>s[24]dd", playername, modelid, price);

  		for(new i = 0, j = GetPlayerPoolSize(); i <= j; i++) {

    		if(!IsPlayerConnected(i)) continue;

    		GetPlayerName(i, pName, sizeof pName);
    		if(!strcmp(pName, playername, false)) {

    			new Float:x, Float:y, Float:z, Float:a;
    			GetPlayerPos(i, x, y, z);
    			GetPlayerFacingAngle(i, a);

    			CreateVehicle(modelid, x + 3, y, z, a, -1, -1, -1);
    			GivePlayerMoney(i, -price);

    			new query[98];
    			mysql_format(connectionHandle, query, sizeof query, "UPDATE `Users` SET `Money` = %i WHERE `Username` = '%e'", GetPlayerMoney(i), pInfo[i][playerName]);
    			mysql_tquery(connectionHandle, query);

    			SendClientMessage(i, 0x00FF00AA, "You have successfully bought a new vehicle from the web shop");
    			format(buyVehicle, sizeof buyVehicle, "BoughtVehicle");
    			break;
    		}
    	}
    	socket_sendto_remote_client(id, remote_clientid, buyVehicle);
    }
    else if(data[0] == '4') { // SetPlayerSkin

    	// 4|PlayerName|SkinID|SkinPrice
    	new buySkin[15];
  		format(buySkin, sizeof buySkin, "FAILED");

  		new skinid, price, playername[MAX_PLAYER_NAME];
  		sscanf(data[2], "p<|>s[24]dd", playername, skinid, price);

  		for(new i = 0, j = GetPlayerPoolSize(); i <= j; i++) {

    		if(!IsPlayerConnected(i)) continue;

    		GetPlayerName(i, pName, sizeof pName);
    		if(!strcmp(pName, playername, false)) {

    			new Float:x, Float:y, Float:z;
    			GetPlayerPos(i, x, y, z);

    			SetPlayerSkin(i, skinid);
    			GivePlayerMoney(i, -price);

    			new query[98];
    			mysql_format(connectionHandle, query, sizeof query, "UPDATE `Users` SET `Money` = %i WHERE `Username` = '%e'", GetPlayerMoney(i), pInfo[i][playerName]);
    			mysql_tquery(connectionHandle, query);

    			SetPlayerPos(i, x, y, z + 0.1);

    			SendClientMessage(i, 0x00FF00AA, "You have successfully bought a new skin from the web shop");
    			format(buySkin, sizeof buySkin, "BoughtSkin");
    			break;
    		}
    	}
    	socket_sendto_remote_client(id, remote_clientid, buySkin);
    }
    return 1;
}

public OnDialogResponse(playerid, dialogid, response, listitem, inputtext[]) {

	switch(dialogid) {

		case DIALOG_LOGIN: {

			if(!response) return Kick(playerid);

			if(!strcmp(inputtext, pInfo[playerid][playerPass])) {

				new query[100];
				mysql_format(connectionHandle, query, sizeof(query), "SELECT * FROM `Users` WHERE `Username` = '%e' LIMIT 1", pInfo[playerid][playerName]);
                mysql_tquery(connectionHandle, query, "OnAccountLoad", "i", playerid);
			}
			else return Kick(playerid);
		}
		case DIALOG_REGISTER: {

			if(!response) return Kick(playerid);

			format(pInfo[playerid][playerPass], 129, inputtext);

			new query[150];
			mysql_format(connectionHandle, query, sizeof query, "INSERT INTO `Users` (Username, Password) VALUES ('%e', '%e')", pInfo[playerid][playerName], pInfo[playerid][playerPass]);
			mysql_tquery(connectionHandle, query, "OnAccountRegister", "i", playerid);
		}
	}
	return 0;
}

public OnAccountCheck(playerid) {

	new rows = cache_num_rows();
	if(rows) {

		cache_get_value_name(0, "Password", pInfo[playerid][playerPass], 129);
		ShowPlayerDialog(playerid, DIALOG_LOGIN, DIALOG_STYLE_PASSWORD, "Login", "{FFFFFF}Welcome back!\n\n{FF0066}Type your password below to login to your game account", "Login", "Quit");
	}
	else ShowPlayerDialog(playerid, DIALOG_REGISTER, DIALOG_STYLE_INPUT, "Register", "{FFFFFF}Welcome!\n\n{FF0066}Type your password below to register game account", "Register", "Quit");
	return 1;
}

public OnAccountLoad(playerid) {

	cache_get_value_name_int(0, "Money", pInfo[playerid][playerMoney]);

	GivePlayerMoney(playerid, pInfo[playerid][playerMoney]);

	TogglePlayerSpectating(playerid, 0);
    SetSpawnInfo(playerid, NO_TEAM, 230, 1682.8351, -2325.5598, 13.5469, 359.1428, 0, 0, 0, 0, 0, 0);
    SpawnPlayer(playerid);
	return 1;
}

public OnAccountRegister(playerid) {

	TogglePlayerSpectating(playerid, 0);
    SetSpawnInfo(playerid, NO_TEAM, 230, 1682.8351, -2325.5598, 13.5469, 359.1428, 0, 0, 0, 0, 0, 0);
    SpawnPlayer(playerid);

    GivePlayerMoney(playerid, 5000000);
	return 1;
}
/**
 * Created by huuthanh3108 on 10/31/13.
 */
'use strict';
var app = angular.module('app',['ngResource','socket-io','angularMoment','LocalStorageModule']);
app.run(['$location', '$rootScope', function($location, $rootScope) {

}]);
function ChatCtrl($scope,$rootScope,$filter,$timeout,$q,localStorageService,socket,flash,UserPaging,UserService) {
    //$scope.msgs = localStorageService.get('msgs')||[];
    //$scope.whisperMsgs = localStorageService.get('whisperMsgs')||[];
    $scope.msgs = [];
    $scope.whisperMsgs = [];    
    $scope.whisperUsers = [];
    $scope.myRoomID = null;
    $scope.currTab = 'tab-room';
    $scope.userInfo = [];
    $scope.rooms = {};
    $scope.myUsername = Chat.user.username;
    $scope.myAvatar =  Chat.user.avatar;
    $scope.frmMsg = {msg:''};
    $scope.focusInput = true;
    UserService.get({'act':'count'},function(respon){
    	$scope.totalUser = respon.total;
    });
    /*
    $scope.$watch('userInfo', function(value) {
       console.log(value);
     });
     */
    /**
     * BEGIN SERVER
     */
    //socket-y stuff
    socket.on("exists", function(data) {
        //console.log(data);
        flash('info', data.msg + " Try <strong>" + data.proposedName + "</strong>");
    });
    socket.on("joined", function() {

    });
    socket.on("initial-notes", function(offMsgs) {
        angular.forEach(offMsgs, function(v,k) {
        	//console.log(v);
          	var flag = checkHasWhisper(v.send);
          	var msg = {"msgtype":2,"whisper":v.send,"send":v.send,"receive":v.receive,"content": v.content,"datesend": (new Date(v.datesend)).getTime()}
            if(flag == false){        	        	
            	$scope.whisperMsgs.push({"whisper":v.send,"read":false,msg:[]});
            	addWhisperMsgs(v.send,msg);
            }
            if(flag == true){
            	addWhisperMsgs(v.send,msg);            	
            } 
        });
        //localStorageService.add('whisperMsgs',$scope.whisperMsgs);
        /*
    	var flag = checkHasWhisper(notes.whisper);
        if(flag == false){        	        	
        	$scope.whisperMsgs.push({"whisper":msg.whisper,"read":false,msg:[]});
        	addWhisperMsgs(msg.whisper,msg);
        }
        if(flag == true){
        	addWhisperMsgs(msg.whisper,msg);
        	localStorageService.add('whisperMsgs',$scope.whisperMsgs);
        } 
        */
    });   
    socket.on("auto-join-room", function(roomId) {
        //console.log('aaa');
       //console.log(roomId);
        $scope.myRoomID = roomId;
        socket.emit("joinRoom", roomId);
    });

    socket.on("update", function(msg) {
        $scope.msgs.push(msg);
        //localStorageService.add('msgs',$scope.msgs);
        jQuery("#conversation").animate({
            scrollTop:jQuery("#conversation")[0].scrollHeight
        }, 1000);
    });

    socket.on("update-people", function(data){
        $scope.onlineUsers = data.users;
        //console.log(!$scope.onlineUsers['addmin']);
        //console.log(data.users);
        $scope.countUser = data.count;
    });
    socket.on("chat", function(person, msg) {
        $scope.msgs.push(msg);
        //localStorageService.add('msgs',$scope.msgs);
        jQuery("#conversation").animate({
            scrollTop:jQuery("#conversation")[0].scrollHeight
        }, 1000);
    });
    var checkHasWhisper = function(whisper){    	
    	var flag = false;       
        angular.forEach($filter('filter')($scope.whisperMsgs,{whisper:whisper}), function(v) {
        	flag = true;        	
        });
        return flag; 
    };
    var addWhisperMsgs = function(whisper,msg){
    	var flag = false;
        angular.forEach($filter('filter')($scope.whisperMsgs,{whisper:whisper}), function(v) {
        	if(msg.receive == whisper && $scope.currTab == whisper){
        		v.read = true;
        	}else {
        		v.read = false;
        	}
        	v.msg.push(msg);
        	flag = true;        	
        });
        return flag;
    };
    socket.on("whisper", function(person,msg) {
    	var flag = checkHasWhisper(msg.whisper);      
        if(flag == false){        	        	
        	$scope.whisperMsgs.push({"whisper":msg.whisper,"read":false,msg:[]});
        	addWhisperMsgs(msg.whisper,msg);
        }
        else{
        	addWhisperMsgs(msg.whisper,msg);
        	//localStorageService.add('whisperMsgs',$scope.whisperMsgs);
        }      	
    });

    socket.on("roomList", function(data) {
        $scope.rooms = data.rooms;
        $scope.countRoom = data.count;
    });

    socket.on("sendRoomID", function(data) {
        $scope.myRoomID = data.id;
    });

    socket.on("disconnect", function(){
    	jQuery("#msgs").append("<li><strong><span class='text-warning'>The server is not available</span></strong></li>");
    	jQuery("#msg").attr("disabled", "disabled");
    	jQuery("#send").attr("disabled", "disabled");
    });
    /**
     * END SERVER
     */
    $scope.joinServer = function(){
        var device = "desktop";
       //var name ="NguyenHuuThanh"+new Date().getTime();
        var name = $scope.myUsername;
        var avatar = $scope.myAvatar;
        var user = {username:name,avatar:avatar};
       // console.log(avatar);
        if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)) {
            device = "mobile";
        }        
        socket.emit("joinserver", user, device);
        //console.log(avatar);
    };
    $scope.sendChat = function(){
        socket.emit("send", $scope.frmMsg.msg);
        $scope.frmMsg.msg = '';
        jQuery("#conversation").animate({
            scrollTop:jQuery("#conversation")[0].scrollHeight
        }, 1000);
    };
    $scope.createRoom = function(){
        var roomExists = false;
        var roomName = 'Public';
        socket.emit("check", roomName, function(data) {
            roomExists = data.result;
            if (roomExists) {
                flash('error', "Room" + roomName + " already exists");
            } else {
                if (roomName.length > 0) { //also check for roomname
                    socket.emit("createRoom", roomName);
                }
            }
        });
    };
    $scope.changeRoom = function(fromRoomId,toRoomId){
        socket.emit("leaveRoom", fromRoomId);
        socket.emit("joinRoom", toRoomId);
    };

    $scope.whisperTo = function(whisper){
    	var flag = checkHasWhisper(whisper);    	
    	if(flag == false){
    		$scope.whisperMsgs.push({"whisper":whisper,"inputMsg":'',"read":true,msg:[]});
       		//$scope.activeTab(whisper);       	
    	}
    	$scope.activeTab(whisper);
       	$timeout(function(){    		
       		jQuery('#myTab3 a[href="#tab-'+whisper+'"]').tab('show');
       		jQuery('#input-'+whisper).focus();
        });
    };
    $scope.sendWhisperTo = function(whisper){
    	var msg='';
        angular.forEach($filter('filter')($scope.whisperMsgs,{whisper:whisper}), function(v) {
        	//v.inputMsg = '';
        	msg = v.inputMsg;
        	v.inputMsg='';
        	v.read = true; 
        });
        socket.emit("send", 'w:'+whisper+':'+ msg);    
        jQuery("#conversation_"+whisper).animate({
            scrollTop:jQuery("#conversation_"+whisper)[0].scrollHeight
        }, 1000);
    	
    };
    $scope.clearAllMsgs = function(){
    	$scope.msgs = [];
    	//localStorageService.remove('msgs');
    };
    $scope.clearAllWhisperMsgs = function(whisper){
        angular.forEach($filter('filter')($scope.whisperMsgs,{whisper:whisper}), function(v) {
         	v.msg = [];            	
        });   
      	//localStorageService.add('whisperMsgs',$scope.whisperMsgs);
    };
    
    $scope.$watch('myRoomID', function(newval, oldval) {
    	//console.log(newval);
        if (newval !== oldval && newval !== null) {      
            angular.forEach($scope.rooms, function(v) {
            	if(v.id == newval){
            		$scope.myRoomName = v.name;            		
            	}            	
            });
        }
    }, true);
    
    $scope.joinServer();
    $scope.activeTab = function(whisper){
    	/*
    	$timeout(function(){    		
    		$('#myTab3 a[href="#tab-'+whisper+'"]').tab('show');
   			$('#input-'+whisper).focus();
        });
        */
    	$scope.currTab = whisper;
    };
    $scope.removeTab = function(whisper){
        angular.forEach($filter('filter')($scope.whisperMsgs,{whisper:whisper}), function(v) {
        	var index=$scope.whisperMsgs.indexOf(v);
        	$scope.whisperMsgs.splice(index,1);
        });
        //localStorageService.add('whisperMsgs',$scope.whisperMsgs);
        //$scope.activeTab('tab-room');
        jQuery('#myTab3 a:first').tab('show');
    };  
/*
    $scope.getUserInfo = function(username){
    	if(!$scope.userInfo[username] == true){
    		if(username=='system'){
        		var data = {avatar:'avatar1.png',name:'Hệ thống'};        	
        		$scope.userInfo[username] = [];
    			$scope.userInfo[username].push(data);
        	}else{
        		UserService.get({"act":"info","username":username},function(data){        			
        			$scope.userInfo[username] = [];
        			$scope.userInfo[username].push(data);
        		});     		
        	}
       		
    	}
    	return $scope.userInfo[username];
    };
    */
    $scope.users = new UserPaging();
    //$scope.activeTab('tab-room');
    //$('#myTab3 a:first').tab('show');
}

@extends('admin_navbar')
@section('content')   
@if(Auth::user()->is_admin == 1)
<div class="app-content content">
        <div class="sidebar-left">
            <div class="sidebar"> 
                <div class="chat-sidebar card"> 
                    <div class="chat-sidebar-list-wrapper"> 
                        <h6 class="px-2 pb-25 mb-0">CHATS</h6>
                        <ul class="chat-sidebar-list">
                            @foreach($chatUsers as $user)
                                <li onclick="showChat(this.id)" id="{{$user->user_id}}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-busy m-0 mr-50"><img src="https://eu.ui-avatars.com/api/?name={{$user->users->name}}&background=random" height="36" width="36" alt="sidebar user image">
                                            <i></i>
                                        </div>
                                        <div class="chat-sidebar-name pl-1">
                                            <h6 class="mb-0">{{$user->users->name}}</h6>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    
                    </div>
                </div>
                <!-- app chat sidebar ends -->
            </div>
        </div>
        <div class="content-right">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- app chat overlay -->
                    <div class="chat-overlay"></div>
                    <!-- app chat window start -->
                    <section class="chat-window-wrapper">
                        <div class="chat-start">
                            <span class="feather icon-message-square chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                            <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
                            <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
                                Conversation!</button>
                        </div>
                        <div class="chat-area d-none">
                            <div class="chat-header">
                                <header class="d-flex justify-content-between align-items-center px-1 py-75">
                                    <div class="d-flex align-items-center">
                                        <div class="chat-sidebar-toggle d-block d-lg-none mr-1">
                                            <i class="feather icon-menu font-large-1 cursor-pointer"></i>
                                        </div>
                                        <div class="avatar avatar-busy chat-profile-toggle m-0 mr-1">
                                            <img src="" id="chat_person_profile_img" alt="avatar" height="36" width="36" />
                                            <i></i>
                                        </div>
                                        <h6 class="mb-0" id="chat_person"></h6>
                                    </div>
                                    
                                </header>
                            </div>
                            <!-- chat card start -->
                            <div class="card chat-wrapper shadow-none mb-0">
                                <div class="card-content">
                                    <div class="card-body chat-container">
                                        <div class="chat-content">  
                                            <div class="chat chat-left">
                                            </div>
                                            <div class="chat chat-right">
                                                
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer chat-footer px-2 py-1 pb-0">
                                    <form class="d-flex align-items-center" onsubmit="chatMessagesSend(this.message.value, this.chat_id.value, this.chat_name.value);" action="javascript:void(0);">
                                        
                                        <input type="hidden" value="" name="chat_id" id="chat_id">
                                        <input type="hidden" value="Admin" name="chat_name" id="chat_name">
                                        <input type="text" name="message" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
                                        <button type="submit" class="btn btn-primary glow send d-lg-flex"><i class="feather icon-play"></i>
                                            <span class="d-none d-lg-block mx-50">Send</span></button>
                                    </form>
                                </div>
                            </div>
                            <!-- chat card ends -->
                        </div>
                    </section> 
                </div>
            </div>
        </div>
    </div>
    <script>
        function showChat(user_id)
        {
            var request = XMLHttpRequest();
            request.open(
                "get",
                "/fetchthread/" + user_id,
                false
            );
            request.send();
            var response = JSON.parse(request.response);
            document.getElementById('chat_person').innerHTML = response[0].users.name;
            document.getElementById("chat_person_profile_img").src = "https://eu.ui-avatars.com/api/?name="+response[0].users.name+"&background=random";
            document.getElementById('chat_id').value = response[0].user_id; 

            var chatLeft = document.querySelector('.chat-left'); 
            chatLeft.innerHTML = '';
            response.forEach(function(message) {
                 
                var messageText = message.message;
                var messageTime = new Date(message.created_at).toLocaleTimeString(); // Assuming created_at is in ISO format
                var userImgSrc = "";
                if (message.is_from_admin == 1) {
                    userImgSrc = "https://eu.ui-avatars.com/api/?name=Admin&background=random";
                }
                else{
                    userImgSrc = "https://eu.ui-avatars.com/api/?name=" + message.users.name + "&background=random";
                } 
                var chat = document.createElement('div');
                chat.classList.add('chat', 'chat-left');

                var chatAvatar = document.createElement('div');
                chatAvatar.classList.add('chat-avatar');

                var avatarLink = document.createElement('a');
                avatarLink.classList.add('avatar', 'm-0');

                var avatarImg = document.createElement('img');
                avatarImg.id = 'userimg';
                avatarImg.src = userImgSrc;
                avatarImg.alt = 'avatar';
                avatarImg.height = 36;
                avatarImg.width = 36;

                avatarLink.appendChild(avatarImg);
                chatAvatar.appendChild(avatarLink);

                var chatBody = document.createElement('div');
                chatBody.classList.add('chat-body');

                var chatMessage = document.createElement('div');
                chatMessage.classList.add('chat-message');

                var messageElement = document.createElement('p');
                messageElement.id = 'usermessage';
                messageElement.textContent = messageText;

                var timeElement = document.createElement('span');
                timeElement.classList.add('chat-time');
                timeElement.id = 'usermessagetime';
                timeElement.textContent = messageTime;

                chatMessage.appendChild(messageElement);
                chatMessage.appendChild(timeElement);
                chatBody.appendChild(chatMessage);

                chat.appendChild(chatAvatar);
                chat.appendChild(chatBody);

                chatLeft.appendChild(chat); 
            });
        }
    </script>
@endif  
@endsection
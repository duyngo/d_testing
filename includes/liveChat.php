<div class="live-chat">
    <button id="chat-open" class="chat-toggle">
        <i class="fa fa-comments-o"></i><br />채팅
    </button>
    <div id="chat-box">
        <div class="chat-head">
            <div class="title">
                <h5 id="chat-room-name">Room name</h5>
            </div>
            <div class="buttons">
                <div class="dropdown">
                    <button class="dropdown-toggle" id="chat-rooms" data-toggle="dropdown">
                        <i class="fa fa-list"></i>
                    </button>
                    <ul class="dropdown-menu" id="rooms"></ul>
                </div>
                <button id="chat-close"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="chat-messages">
        </div>
        <div class="chat-footer">
            <div id="chat-auth">
                <a href="#" class="btn btn-ask-black hvr-shadows" data-backdrop="true" data-toggle="modal" data-target="#myModal" id="signIn" onclick='$("body").removeClass("chat-active");'>Login</a>
            </div>
            <form id="chat-form">
                <input name="message" placeholder="Say something...">
                <button><i class="fa fa-send"></i></button>
            </form>
        </div>
        <div class="chat-status">
            <span id="chat-online-users">...</span> users online.
        </div>
    </div>
</div>

<style>
    body {transition: padding .5s;}
    .chat-active #chat-open {display: none !important;}
    .chat-active #chat-box {left: 0 !important;}
    .chat-active {padding-left: 300px;}
    .live-chat #chat-box {
        z-index: 99999999999;
        position: fixed;
        left: -300px;
        top: 0;
        right: 0;
        bottom: 0;
        width: 300px;
        transition: left .5s;
        display: flex;
        flex-direction: column;
    }
    .live-chat .chat-toggle {
        position: fixed;
        left: 0;bottom: calc(50% - 30px);
        height: 60px;
        width: 60px;
        border-radius: 0 3px 3px 0;
        border: none;
        color: #ddd;
        transition: left .5s;
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #595a5c 0%, #2f3439 22%, #21272d 35%, #21272d 80%, #293039 100%) repeat scroll 0 0;
        outline: none;
    }
    .live-chat .chat-toggle > i {
        font-size: 200%;
        margin-bottom: 4px;
    }
    .live-chat .chat-head {
        height: 52px;
        display: flex;
        color: white;
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #595a5c 0%, #2f3439 22%, #21272d 35%, #21272d 80%, #293039 100%) repeat scroll 0 0;
    }
    .live-chat .chat-head .title {
        margin-right: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: .5em 1em;
    }
    .live-chat .chat-head .title > h3 {
        margin: 0;
    }
    .live-chat .chat-head .buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: .5em;
    }
    .live-chat .chat-head .buttons button {
        background-color: transparent;
        padding: .5em;
        border: none;
        outline: none;
        font-size: 110%;
    }
    .live-chat .chat-messages {
        align-self: stretch;
        background-color: #1a2323;
        height: calc(100vh - 61px);
        overflow: auto;
        padding: 1em;
    }
    .live-chat .chat-footer {
        background-color: #111;
        border-top: 1px solid #666;
        padding: .4em;
    }
    .live-chat #chat-auth {
        text-align: center;
    }
    .live-chat #chat-form {
        display: none;
        width: 100%;
        background: rgba(0,0,50, 0.3);
        border-radius: 4px;
        resize: none;
        border: 1px solid #444;
        color: #ccc;
        outline: none;
    }
    .live-chat #chat-form button {
        background-color: transparent;
        border: none;
        color: #fff;
        outline: none;
    }
    .live-chat #chat-form input {
        background-color: transparent;
        border: none;
        padding: .4em .7em;
        outline: none;
        width: 100%;
    }
    .live-chat .chat-status {
        background-color: #111;
        color: #aaa;
        font-size: 80%;
        text-align: center;
    }
    .live-chat .message {
        display: flex;
    }
    .live-chat .message > .msg {
        padding: .3em;
        color: #aaa;
        background-color: rgba(0, 0, 20, 0.2);
        border: 1px solid #444;
        border-radius: 3px;
        font-size: 90%;
        margin-bottom: 5px;
        word-break: break-all;
        width: 100%;
        margin-left: 12px;
    }
    .live-chat .message > .av {
        position: relative;
    }
    .live-chat .message > .av > img {
        border-radius: 50%;
        height: 42px;
        width: 42px;
        border: 3px solid #333;
    }
    .live-chat .message > .av > span {
        background-color: #333;
        color: #aaa;
        display: block;
        width: 16px;
        height: 16px;
        font-size: 80%;
        text-align: center;
        border-radius: 50%;
        font-weight: bold;
        position: absolute;
        top: 0;
        right: 0;
    }
    .live-chat .message.admin > .av > img {
        border-color: gold;
    }
    .live-chat .message.admin > .av > span {
        display: none;
    }
    @media only screen and (max-width: 600px) {
        .chat-active #chat-box {right: 0; width: 100%;}
        .chat-active {padding-left: 0 !important;}
    }
</style>
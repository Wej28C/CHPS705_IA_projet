from websocket_server import WebsocketServer

def new_client(client, server):
    server.send_message_to_all("Hey all, a new client has joined us")

def message_received(client, server, message):
    if len(message) > 200:
        message = message[:200] + '..'
    print(f"Client({client['id']}) said: {message}")

server = WebsocketServer(port=12345, host='127.0.0.1')
server.set_fn_new_client(new_client)
server.set_fn_message_received(message_received)
server.run_forever()

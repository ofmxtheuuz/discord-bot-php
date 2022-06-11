# Bot Discord com PHP

Normalmente vemos bots no discord construido em Javascript mas em PHP são poucos.<br>
Além da pouca media usando PHP e uma documentação fraca, estou aqui pra ajudar um pouco mais vocês!<br>

## Projeto
Bom, esse projeto não é dos mais comuns mas a partir desse vocês conseguem fazer vários outros.<br>
É bem simples, vamos anexar um botão a uma mensagem enviada pelo bot e que quando o usuário clica no botão, é enviada uma mensagem no seu privado.<br>

## Primeiro Passo | Token e instalação
Para criar qualquer bot (independente da linguagem), precisamos do token...<br>
Para ter acesso ao token, você deve entrar no <a href="https://discord.com/developers/applications">Portal de desenvolvedores do Discord</a>.<br>
Após isso, você deve criar uma aplicação e obter o token.<br>
Vamos criar o projeto na sua IDE preferida e vamos requisitar um pacote do discord no <a href="https://getcomposer.org">composer</a>.<br>
Abra a pasta do projeto no terminal (cmd) e requisitamos

```
composer require team-reflex/discord-php
```

O composer será instalado na pasta do seu projeto junto com os arquivos do discord...
Vamos criar um arquivo index e sempre que estamos falando de composer, não podemos esquecer de incluir ele no arquivo

```php
require __DIR__ . '/vendor/autoload'
```

Além disso, vamos usar a classe

 ```php
use Discord\Discord;
```

## Terceiro Passo | Instanciando Classe
Com o token do bot em mãos, vamos instanciar a classe Discord (que usaremos para muita coisa!)

```php
$discord = new Discord([
    'token' => 'TOKEN_DO_SEU_BOT',
]);
```

Pronto, a classe foi instanciada e também é importante falar o que vai acontecer quando o bot for inicializado (normalmente é apenas uma mensagem no terminal)

```php
$discord->on('ready', function (Discord $discord) {
    echo "BOT ONLINEEE!", PHP_EOL;
}
```

Também é importante inicializar o bot

```php
$discord->run();
```

Lembrando, todo o nosso código irá dentro dessa função "on", então todo o código que estiver a baixo será dentro dessa função.

## Quarto Passo | Verificando Mensagem
Se executarmos esse arquivo, se tudo estiver correto, o bot vai ficar online!<br>
Precisamos verificar a chegada da mensagem e com essa verificação, conseguimos ver quem enviou ela entre muitas outras coisa...<br>

```php
$discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
  if ($message->content == '!Hello') {
   /////////////
  }
}
```

"Event::MESSAGE_CREATE" identifica quando uma mensagem é enviada por algum usuário e ele nos fornece uma variavel chamada "$message"<br>
Com essa variavel, conseguimos acessar o id do usuário que enviou essa mensagem, o que está escrita nela etc...<br>
Nesse caso, verificamos se a mensagem enviada é "!Hello" e aqui você pode modificar do seu jeito!<br>

## Quinto Passo | Enviando uma Mensagem com Botão
```php
$builder = MessageBuilder::new(); // Cria a base da mensagem
$builder->setContent('Hello, World!'); // O que está escrito na mensagem!

$actionRow = ActionRow::new(); // Actions para o botão
$buttonSuccess = Button::new(Button::STYLE_SUCCESS); // Criando a base do botão
$buttonSuccess->setLabel('Click'); // O que vai estar escrito no botão  
$actionRow->addComponent($buttonSuccess); // Adicionando o botão na Action
$builder->addComponent($actionRow); // Adicionando a Action com o botão na mensagem

$message->channel->sendMessage($builder); // Enviando a mensagem
```

O resultado disso vai ser algo parecido com isso<br><br>
<img src="https://cdn.discordapp.com/attachments/821171885638549504/985279690723966997/unknown.png">

## Sexto Passo | Enviando mensagem no Privado
```php
$buttonSuccess->setListener(function ($interaction) use ($discord) {
  $interaction->user->sendMessage(MessageBuilder::new()->setContent("Hello, World!")); // Pega o id do usuário e envia uma mensagem no privado
}, $discord);
```

A função "setListener" cria uma verificação e é ativada sempre que alguém clica no botão<br> 
Igual com as mensagem, essa função gera uma variável "$interaction"<br>

Seja feliz!

# Observações
Sei que esse repositorio foi muito especifico mas vou ensinar a fazer coisas básicas

## Como enviar mensagem em chats
Para enviar mensagens em chats, você precisa do canal, e você pode fazer isso de várias formas, a principal é com algum recebimento de mensagem<br>

```php
$message->channel->sendMessage("Hello, World!");
```

## O que é MessageBuilder
Ele serve para construir mensagens ou seja, criar uma mensagem, adicionar anexos, reações, botões etc.<br>
Em outras palavras, ele auxilia o construção de mensagens


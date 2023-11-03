@extends('Default.layout')
@section('section')
    <div class="postagem ver">
        <h1>{{$post->titulo}}</h1>
        <div class="add-info">
            <span>Autor: {{$post->usuario->nome}}</span>
            <span>{{$post->dataFormatadaUsuario()}}</span>
        </div>
        <p>{{$post->descricao}}</p>
<div class="conteudo">
    <h2>O que é o QZ Tray?</h2>
    <p>
        O QZ Tray é um utilitário gratuito que permite que você imprima etiquetas, códigos de barras, recibos e muito mais de uma página da web usando HTML, JavaScript e Java. Ele está disponível para Windows, macOS e Linux e roda em Intel e ARM / Apple Silicon.
    </p>
    <p>
        Além disso, ele pode ser implementado direto no Front-End de sua aplicação, usando apenas JavaScript e instalando seu arquivo executável, com ele funcionando é possível recuperar todas as impressoras, que constam no seu sistema, pelo menos eu testei isso no windows e funcionou perfeitamente.
    </p>
    <p>
        também é suportado a impressão de arquivos .PDF e PDF em formato base64, contando com várias outras funcionalidades que poderão ser observadas no <a href="https://qz.io/" target="__blank">site oficial</a>.
    </p>
    <p>
        <span style="font-weight: bold">Informações sobre esse tutorial:</span> acredito que a maioria das pessoas que virão esse tutorial serão usuários do windows, algumas etapas em outros Sistemas Operacionais poderão ser diferentes, se atente a isso.
        <span style="font-weight: bold">Também vale dizer que esse tutorial é direcionado ao aprendizado, por isso, serei cirurgico nas etapas.</span>
    </p>

    <h2>1. Instalação do QZ Tray</h2>
    <p>Você pode encontrar o download do QZ Tray através do site oficial, clicando <a href="https://qz.io/download/" target="__blank">aqui</a>, o método de instalação é bem simples, no próprio site você pode encontrar facilmente a instalação de acordo com seu SO.</p>

    <h2>2. Como imprimir?</h2>
    <p>
        Depois da instalação concluída, o QZ Tray criará uma pasta, se você não mudou o caminho será:
        <ul style="align-self: flex-start">
            <li>Windows: <span style="font-weight: 600">C:\Program Files\QZ Tray</span></li>
            <li>MacOS: <span style="font-weight: 600">/Applications/QZ Tray.app/Contents/Resources</span></li>
            <li>MacOS 2.1 e anteriores: <span style="font-weight: 600">/Applications/QZ Tray.app</span></li>
            <li>Linux: <span style="font-weight: 600">/opt/qz-tray</span></li>
        </ul>
    </p>
    <p>
        Você precisará chamar um arquivo JavaScript no seu Front-End, que é o arquivo: demo\js\qz-tray.js você poderá copiar esse arquivo para o seu projeto e deixar com outros arquivos .js que você utiliza.
    </p>
    <p>No HTML ficará assim.</p>
    <code>
        <span>HTML</span>
        <button class="btn" onclick="pegarConteudoCopiar('codigoHTML1')" style="align-self: flex-end; margin-right: 25px">Copiar</button>
        <pre class="codigoHTML" id="codigoHTML1">

&lt;script type="text/javascript" src="js/qz-tray.js"&gt;&lt;/script&gt;
        </pre>
    </code>

    <p>Continuando, você deverá se conectar ao qz, essa conexão é com o executável instalado, para reconhecer a impressora e mandar a impressão.</p>
    
    <p>
        Agora abra uma tag <span style="font-weight: bold">&lt;script type="text/javascript"&gt;&lt;/script&gt;</span>
    </p>

    <p>
        Dentro dessa tag vá adicionando os código mostrados abaixo.
    </p>

    <code>
        <span>JavaScript</span>
        <button class="btn" onclick="pegarConteudoCopiar('CodigoJS1')" style="align-self: flex-end; margin-right: 25px">Copiar</button>
        <pre class="codigoFunc" id="CodigoJS1">

qz.websocket.connect().then(function() {
    console.log("Connected!");
});
        </pre>
    </code>

    <p>
        Para obter a lista de impressoras usa-se esse código:
    </p>

    <code>
        <span>JavaScript</span>
        <button class="btn" onclick="pegarConteudoCopiar('CodigoJS2')" style="align-self: flex-end; margin-right: 25px">Copiar</button>
        <pre class="codigoFunc" id="CodigoJS2">

qz.printers.find().then(function(data) {			
    for(var i = 0; i < data.length; i++) {
        $('#printers').append(`&lt;option value="${data[i]}"&gt;${data[i]}&lt;/option&gt;`)              
    }
}).catch(function(e) {
    console.error('Erro: '+e);
});
        </pre>
    </code>
    
    <p>
        No código acima utilizei a lista de impressoras para criar um select com as opções de impressoras para mandar a impressora selecionada, a lista de impressoras é retornada pela variável data[i], código usando <a href="https://api.jquery.com/" target="__blank">JQUERY</a>.
    </p>
    
    <p>
        O conteúdo impresso poderá ser feito usando um arquivo .PDF
    </p>

    <code>
        <span>JavaScript</span>
        <button class="btn" onclick="pegarConteudoCopiar('CodigoJS4')" style="align-self: flex-end; margin-right: 25px">Copiar</button>
        <pre class="codigoFunc" id="CodigoJS4">

var data = [{ 
    type: 'pixel',
    format: 'pdf',
    flavor: 'file',
    data: 'caminho-do-arquivo.pdf'
}];
//a variável printer é o valor retornado do select, exemplo: Microsoft Print to PDF
var config = qz.configs.create(printer)
qz.print(config, data).catch(function(e) {
    console.error('Erro: '+e)
});
        </pre>
    </code>

    <p>
        Vale ressaltar que você pode colocar o nome da impressora diretamente no código, com o mesmo nome que aparece no seu sistema, com excessão do MacOS que poderá vir ao invés de espaço no nome, um underline, exemplo: Zebra LP2844, poderá ser: Zebra_LP2844, isso poderá ser notado em alguns casos em Java no MacOS.
    </p>

    <p>
        No projeto que eu precisei utilizar o sistema de impressão o melhor caminho seria utilizar o pdf em formato base64, isso é possível usando o qz, como também é possível imprimir um conteúdo direto do html. Para isso aconselho ler a documentação do QZ Tray clicando <a href="https://qz.io/docs/pixel" target="__blank">aqui</a>, especificamente nesse link há todos os tipos de impressão, na dúvida, acesse.
    </p>

    <p>Após isso aparecerá um pop-up para confirmação, basta permitir e se tudo der certo irá imprimir, caso não funcione se atente aos erros no console.</p>

    <h2>3. Como gerar um certificado autoassinado?</h2>

    <p>
        <span style="font-weight: bold">ATENÇÃO: essa parte do tutorial tem como objetivo o aprendizado, não recomendo que usem um certificado autoassinado em sistemas em produção por conta da sua segurança.</span>
    </p>

    <h3>3.1 Programas necessários</h3>

    <p>
        Para o certificado autoassinado funcionar, você deve recompilar os arquivos do QZ para gerar um novo executável com o certificado, os programas necessários são:
        <ul style="align-self: flex-start">
            <li>JDK 7 ou Superior: <a href="https://www.oracle.com/java/technologies/downloads/" style="font-weight: bold" target="__blank">Download</a></li>
            <li>Apache Ant: <a href="https://ant.apache.org/bindownload.cgi" style="font-weight: bold" target="__blank">Download</a></li>
            <li>Nsis 3.0+: <a href="https://nsis.sourceforge.io/Download" style="font-weight: bold" target="__blank">Download</a></li>
            <li>OpenSSL:<a href="https://slproweb.com/products/Win32OpenSSL.html" style="font-weight: bold" target="__blank">Download</a></li>
        </ul>
    </p>

    <h3>3.2 Instale o JDK e o Apache Ant</h3>

    <p>
        O JDK e o Apache Ant são instalados como variáveis de ambiente, baixe os arquivos em .zip e descompacteo-os, renomei o nome da pasta do Apache Ant para 'ant', mova as pastas do ant e do jdk para o diretório 'C:', para instala-los basta clicar no botão do windows e pesquisar: variáveis de ambiente (coloque o acento na letra 'a' da palavra variável, pois o windows pode não encontrar o programa e mostrar uma página web), você deverá entrar no resultado com o nome 'Editar as variáveis de ambiente do sistema', quando clicar irá abrir uma propriedade do sistema, a opção do menu é a 'Avançada', se ele não abrir direto clique nela, depois vá na opção 'Variáveis de Ambiente', após clicado irá mostrar uma outra tela com dois tipos de variáveis, as de usuário e do sistema, clique em novo na parte de variáveis do sistema, no nome da variável coloque como 'ANT_HOME', e o valor da variável coloque 'c:\ant' esse valor é o caminho da pasta, ou seja, se você colocou outro nome ou em outro local deverá colocar o caminho para a pasta, e pronto, instalado.
    </p>

    <p>
        Agora para instalar o jdk faça a mesma coisa, coloque o nome da variável como 'JAVA_HOME' e o valor 'c:\jdk1.7.0_51', lembrando que é o nome da pasta e o local onde ela está, a sua pasta pode ter outro nome pois você pode baixar outra versão, certifique-se de adicionar o mesmo nome da pasta. Agora adicione mais uma variável com o nome 'PATH' e o valor será '%PATH%;%ANT_HOME%\bin'.
    </p>

    <p>Isso no Windows 10, caso use outro SO, com uma breve pesquisa você irá conseguir instalar.</p>

    <h3>3.3 Baixe o repositório no git do QZ</h3>

    <p>
        Para baixar clique <a href="https://github.com/qzind/tray" target="__blank">aqui</a> para baixar, na página, clique no botão verde com o texto 'code', selecione a opção 'Download ZIP', descompacte a pasta e mova pra um local de melhor manejo, você irá precisar referenciar esse local daqui um tempinho.
    </p>

    <h3>3.4 Gerar o arquivo cert.pem</h3>

    <p>
        Para gerar esse arquivo você terá que usar uma chave como base, eu tentei gerar algumas chaves com o OpenSSL mas quando fiz todo o processo no QZ e no site me retornou um erro no console.log dizendo que a chave era curta, se você quiser tentar pode usar esse comando no promp.
    </p>

    <code>
        <span>PROMPT</span>
        <pre style="color: white !important">

openssl req -x509 -newkey rsa:2048 -keyout key.pem -out cert.pem -days 11499 -nodes
        </pre>
    </code>

    <p>
        Para usar esse comando clique no botão do windows e pesquise Open, irá mostrar o programa 'Win64 OpenSSL Command Prompt', clique nele e cole o comando, ele irá cria a chave e o certificado na pasta que ele abre, você pode mudar o local usando o comando 'cd' e colocando o nome do caminho completo exemplo (se você gerou o certificado e não usou o comando cd ele irá para a pasta dos usuários): 'C:\Users\Antonio Marcos>' (Antonio Marcos é o meu usuário, o seu vai ser diferente).
    </p>

    <h3>3.5 Pegar chave direto do servidor (HostGator)</h3>

    <p>Se você possui um servidor na hostgator poderá pegar a chave direto do servidor, no painel vá na opção SSL/TLS Status, ou Status do certificado SSL/TLS, na tabela de domínios clique em 'Exibir certificado', role a página até 'Chave privada (KEY)', copie o conteúdo e crie um arquivo com o nome 'key.pem'.</p>

    <p>
        Para gerar o certificado você deve ir com o programa 'Win64 OpenSSL Command Prompt' até a pasta que você criou o arquivo 'key.pem', se você criou o arquivo na pasta documentos pode abri-la assim: 'cd C:\Users\seu-usuario\Documents' e usar o comando abaixo para gerar o arquivo 'cert.pem'.
    </p>

    <code>
        <span>PROMP</span>
        <pre style="color: white !important">

openssl req -new -key key.pem -out csr.pem
        </pre>
    </code>

    <p>Agora por fim para concluir e usar o arquivo 'csr.pem' para criar o 'cert.pem' basta utilizar o comando abaixo, que também cria a autoassinatura.</p>

    <code>
        <span>PROMP</span>
        <pre style="color: white !important">

openssl x509 -req -days 365 -in csr.pem -signkey key.pem -out cert.pem
        </pre>
    </code>
    
    <p>Ele dura 365 dias, mas você pode alterar o valor para um número maior ou menor.</p>

    <h3>3.6 Preencher informações que apareceram no PROMP</h3>
    <p>
        Nas etapas anteriores você deve ter visto o PROMP fazendo algumas perguntas depois de rodar os comandos, pois agora vou falar o que são cada uma.
        <ul>

            <li>Country Name (2 letter code) [XX]: É o país, exemplo BR.</li>

            <li>State or Province Name (full name) [Some-State]: É o estado ou província, exemplo: Distrito Federal.</li>

            <li>Locality Name (eg, city) []: É a cidade, exemplo: Brasilia.</li>

            <li>Organization Name (eg, company) [Internet Widgits Pty Ltd]: É o nome da empresa, exemplo: Minha Empresa.</li>

            <li>Organizational Unit Name (eg, section) []: É o setor da empresa, exemplo: TI.</li>

            <li>Common Name (e.g. server FQDN or YOUR name) []: É o link do site, também muito importante, para preencher você não pode colocar https://www, deve-se usar *. para substituir, exemplo: *.codigododia.com.br</li>

            <li>Email Address []: É o e-mail da empresa. </li>
        </ul>
    </p>

    <h3>3.7 Gerar chave no formato .pfx</h3>

    <p>Para gerar a chave corretamente use o comando abaixo, você deve estar na mesma pasta da chave 'key.pem'</p>

    <code>
        <span>PROMP</span>
        <pre style="color: white !important">

openssl pkcs12 -inkey key.pem -in cert.pem -export -out privateKey.pfx
        </pre>
    </code>

    <h3>3.8 Gerar o novo executável do QZ</h3>

    <p>Você deve abrir o PROMP de comando do windows e navegar até a pasta que você descompactou do código do git, exemplo (se você descompactou na pasta Download): 'cd C:\Users\seu-usuario\Downloads\tray-master'.</p>

    <p>
        Agora você deve usar o comando abaixo e fazer as devidas alterações.
    </p>

    <code>
        <span>PROMPT</span>
        <pre style="color: white !important">

c:\ant\bin\ant nsis -Dauthcert.use="c:\OpenSSL-Win64\bin\cert.pem"            
        </pre>
    </code>

    <p>
        'c:\ant\bin\ant' é onde você colocou os arquivos do Apache Ant no início do tutorial, ou seja, se você não alterou o nome da pasta você deve colocar extamente como está lá.
    </p>

    <p>
        'c:\OpenSSL-Win64\bin\cert.pem' é o caminho do certificado, ou seja, se você criou ele na pasta Documents deve ficar assim -Dauthcert.use="C:\Users\seu-usuario\Documents\cert.pem".
    </p>

    <h3>3.9 Se tudo correu bem</h3>

    <p>
        Se tudo der certo ele mostra no prompt a mensagem build successfully, isso pode demorar alguns minutos.
    </p>

    <p>
        Se isso aconteceu então na pasta que você descompactou do git deve ter uma pasta dentro dela chamada 'out', com 4 pastas e o arquivo executável que você deve instalar.
    </p>

    <h3>3.10 Assinar as mensagem na sua aplicação</h3>

    <p>
        Apenas instalar o programa não vai funcionar, ou seja, não vai remover o pop-up, você deve mandar uma requisição com a chave e o certificado para autorização, você pode ver mais jeitos de fazer isso clicando <a href="https://qz.io/wiki/2.0-signing-messages
        " target="__blank">aqui</a>.
    </p>

    <p>
        Mas vou ensinar o jeito que para mim foi mais fácil.
    </p>

    <p>
        Antes do qz.connect(... cole o seguinte código e alterei o que eu comentei no código.
    </p>

    <code>
        <span>JavaScript</span>
        <button class="btn" onclick="pegarConteudoCopiar('CodigoJS5')" style="align-self: flex-end; margin-right: 25px">Copiar</button>
        <pre class="codigoFunc" id="CodigoJS5">
//Você deve colar o conteúdo dentro do arquivo cert.pem e colar aqui, menos a primeira linha com -----BEGIN CERTIFICATE-----\n e a última com -----END CERTIFICATE-----
var certificado = ``

//Você deve colar o conteúdo dentro do arquivo key.pem e colar aqui, menos a primeira linha com -----BEGIN PRIVATE KEY-----\n e a última com -----END PRIVATE KEY-----
var chave = ``

qz.security.setCertificatePromise(function (resolve, reject) {
    resolve("-----BEGIN CERTIFICATE-----\n" +
            certificado + "\n" +
            "-----END CERTIFICATE-----");
});

var privateKey = "-----BEGIN PRIVATE KEY-----\n" +
        chave + "\n" +
        "-----END PRIVATE KEY-----";

qz.security.setSignaturePromise(function (toSign) {
    return function (resolve, reject) {
        try {
            var pk = new RSAKey();
            pk.readPrivateKeyFromPEMString(strip(privateKey));
            var hex = pk.signString(toSign, 'sha1');
            console.log("DEBUG: \n\n" + stob64(hextorstr(hex)));
            resolve(stob64(hextorstr(hex)));
        } catch (err) {
            console.error(err);
            reject(err);
        }
    };
});

function strip(key) {
    if (key.indexOf('-----') !== -1) {
        return key.split('-----')[2].replace(/\r?\n|\r/g, '');
    }
}
        </pre>
    </code>

<p>
    também cole isso no seu arquivo HTML:
</p>

<code>
    <span>HTML</span>
    <button class="btn" onclick="pegarConteudoCopiar('codigoHTML5')" style="align-self: flex-end; margin-right: 25px">Copiar</button>
    <pre class="codigoHTML" id="codigoHTML5">
&lt;script src="https://cdn.jsdelivr.net/gh/kjur/jsrsasign@89f70bd4872473733f10579a77b554c81f3a7136/jsrsasign-all-min.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script&gt;
console.log(KJUR.jws.JWS.verify("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWUsImp0aSI6IjE3NjU4OGY3LWZkZGItNDcxNi05ZTFkLTdhN2I1NjE4ZjIzOCIsImlhdCI6MTYxMDEwMjcxNCwiZXhwIjoxNjEwMTA2MzE0fQ.hv9GTjZHgxCk4rfoFaj79vn40OsvtpG0MxOhYZZYAjI", "736563726574"));
&lt;/script&gt;
    </pre>
</code>

    <p>
        Os scripts servem para chamar o KJUR para descriptar a chave.
    </p>

    <h2>4 Fim</h2>
    <p>Esse foi o tutorial, espero ter ajudado, se não funcionou se atente aos erros de PROMP e de console.log.</p>
</div>              
@endsection

@section('javascript')
    <script src="{{asset('js/verView.js')}}?{{getenv('APP_VERSION')}}"></script>
@endsection
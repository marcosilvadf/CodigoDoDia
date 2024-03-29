<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function previsao(Request $request) {
        $previsoes = [
            "Hoje, você vai encontrar um gato que vai tentar te convencer a se juntar ao clube secreto dos felinos.",
            "Prepare-se para uma batalha épica com o despertador amanhã. Spoiler: o despertador pode vencer.",
            "Uma nuvem em forma de batata frita vai cruzar o seu caminho e trazer boa sorte.",
            "Seu horóscopo diz que hoje é o dia perfeito para fazer uma dança ridícula quando ninguém estiver olhando.",
            "Um pato misterioso pode aparecer e oferecer conselhos profundos sobre a vida. Acredite nele.",
            "Cuidado com os pinguins disfarçados de flamingos. Eles podem tentar recrutar você para uma festa secreta na Antártica.",
            "O universo conspira a seu favor hoje, mas apenas se você usar meias de abacate.",
            "Um pombo pode roubar seu lanche hoje. Esteja preparado para uma negociação de comida com penas.",
            "Seu café da manhã será surpreendido por uma torrada que se parece estranhamente com a sua celebridade favorita.",
            "O sol vai conspirar para dar um bronzeado em forma de emoji sorridente na sua testa.",
            "Você pode descobrir que tem um talento secreto para imitar a voz de um pato. Use-o com sabedoria.",
            "Seu telefone pode tocar com uma ligação de um unicórnio perdido. Eles pedirão direções para o arco-íris mais próximo.",
            "Um guru invisível pode aparecer para lhe dar conselhos sobre como ser mais eficiente... enquanto você procura por ele.",
            "Haverá uma chance de 99% de que você encontre algo estranho no fundo da sua bolsa. Boa sorte decifrando o mistério.",
            "Um alienígena pode enviar mensagens subliminares para convencê-lo a comer mais pizza. Não resistir pode ser a melhor opção.",
            "Você vai descobrir que tem uma habilidade incrível para prever o sabor dos alimentos só de olhar para eles.",
            "Hoje é o dia em que as plantas de casa conspirarão para trocar de lugar enquanto você estiver distraído.",
            "Uma formiga pode fazer uma apresentação dramática sobre a importância da cooperação em sua cozinha.",
            "Cuidado com o par de meias que parece inofensivo. Pode ser a próxima estrela do seu show de marionetes improvisado.",
            "Um esquilo pode desafiar você para uma corrida de obstáculos. Prepare-se para uma competição acirrada.",
            "Um arco-íris vai se materializar sempre que você disser 'abracadabra'. Teste isso com cautela.",
            "Um palhaço invisível pode tentar lhe fazer cócegas quando você menos esperar. Esteja alerta para risadas inexplicáveis.",
            "Seu reflexo no espelho pode começar a fazer piadas. Mostre a ele que você também tem senso de humor.",
            "Um hipopótamo pode aparecer no seu jardim. Ofereça-lhe um chá e peça conselhos de vida.",
            "Um lobo solitário pode tentar convencê-lo a fazer uma festa do pijama com outros animais de pelúcia.",
            "Você pode receber uma carta de amor do seu sanduíche favorito. Responda com carinho, mas não o coma antes de casar.",
            "Um abacaxi pode desafiar você para um jogo de xadrez. Não subestime a estratégia frutífera.",
            "Cuidado com as palavras hoje - o vento pode levar seus segredos mais engraçados para longe.",
            "Seu travesseiro pode revelar seus sonhos mais estranhos quando você não estiver olhando.",
            "Um elefante cor-de-rosa pode cruzar o seu caminho. Tire uma selfie, pode ser a prova de que ele existe.",
            "Você pode receber uma mensagem de texto de um pombo-correio. Responda educadamente; eles podem ser sensíveis.",
            "Seu espelho pode refletir uma versão de você com um bigode extravagante. Aceite a mudança com elegância.",
            "Um pato de borracha pode aparecer na sua banheira. Ele pode estar investigando o ambiente aquático da sua casa.",
            "Você pode ser desafiado por um duende a encontrar o pote de ouro no final do arco-íris. Aceite o desafio com entusiasmo.",
            "Um caracol pode tentar lhe ensinar a arte da paciência. Aproveite a oportunidade para aprender com um mestre lento.",
            "Uma tartaruga pode ultrapassar você enquanto estiver andando. Tire isso como um lembrete de que a vida é uma corrida lenta.",
            "Você pode encontrar uma poção mágica esquecida na geladeira. Beba-a com moderação; pode causar risos incontroláveis.",
            "Seu computador pode começar a gerar memes automaticamente. Compartilhe-os com o mundo e seja famoso.",
            "Uma galinha pode desafiar você para um jogo de tabuleiro. Ela pode ser uma adversária estrategicamente avançada.",
            "Você pode descobrir que tem a capacidade de traduzir o miado dos gatos. Prepare-se para conversas profundas.",
            "Um espírito alegre pode sussurrar piadas no seu ouvido enquanto você tenta dormir. Agradeça pela companhia noturna.",
            "Você pode encontrar uma máquina do tempo na garagem. Use-a para corrigir aquelas escolhas de moda duvidosas do passado.",
            "Seu travesseiro pode se transformar em um portal para um mundo de sonhos onde os unicórnios são seus conselheiros pessoais.",
            "Você pode receber uma mensagem de um astronauta perdido pedindo direções para a lua. Forneça coordenadas com precisão.",
            "Hoje é o dia em que o seu café pode desenvolver poderes telepáticos e sussurrar segredos universais enquanto você bebe.",
            "Um pato pode tentar lhe vender seguros. Ouça a oferta, mas pense duas vezes antes de assinar qualquer contrato.",
            "Cuidado com os tomates na geladeira - eles podem estar tramando uma revolução contra as saladas.",
            "Você pode descobrir que tem o talento natural para fazer beatbox com sons de animais. Grave e compartilhe com o mundo.",
            "Uma minhoca pode tentar lhe ensinar a arte da dança subterrânea. Siga o ritmo das raízes.",
            "Você pode se tornar amigo de um corvo que gosta de contar piadas. Divirta-se com suas histórias corvineamente engraçadas.",
            "Um relógio pode começar a contar o tempo ao contrário. Aproveite a oportunidade para viver cada momento de forma única."
        ];
        
        return "@" . $request->nome . " " . $previsoes[rand(0, 51)];
    }

    public function apelido(Request $request) {
        $apelidos_carinhosos_engracados = [
            "Amigão do Peito",
            "Fofurinha Mágica",
            "Picolé de Abacate",
            "Chiclete de Uva",
            "Girassol Sorridente",
            "Abraço de Pijama",
            "Sorvete de Bacon",
            "Panqueca de Carinho",
            "Abobrinha Encantada",
            "Pipoca Saltitante",
            "Bolo de Arco-Íris",
            "Pinguim Maluco",
            "Abraço de Almofada",
            "Esquilo Saltitante",
            "Tigre de Abraços",
            "Banana Cósmica",
            "Champanhe de Cachoeira",
            "Macarrão Saltitante",
            "Girafa Sorridente",
            "Cupcake de Estimação",
            "Pé de Pijama",
            "Almofada Saltitante",
            "Pirulito de Abraços",
            "Tartaruga Feliz",
            "Pimentão Saltitante",
            "Mochila Abraçante",
            "Pão de Queijo Amigo",
            "Sapato de Pelúcia",
            "Panda Apaixonado",
            "Cacto Sorridente",
            "Sorvete de Sushi",
            "Muffin Saltitante",
            "Girino Saltitante",
            "Waffle de Abraços",
            "Uva Saltitante",
            "Bolinha de Queijo",
            "Melancia Saltitante",
            "Banana Ninja",
            "Marshmallow Saltitante",
            "Rã Saltitante",
            "Pizza de Pelúcia",
            "Caracol Carinhoso",
            "Unicórnio Saltitante",
            "Abraço de Travesseiro",
            "Bolinho de Chuva Saltitante",
            "Panda Saltitante",
            "Queijo Quente Amigo",
            "Cachorro-Quente Aconchegante",
            "Lindão da vó"
        ];        
        
        return "@" . $request->nome . " seu apelido é: " . $apelidos_carinhosos_engracados[rand(0, 49)];
    }

    public function causa(Request $request) {
        $causas_de_morte_engracadas = [
            "Morte por overdose de risadas",
            "Ataque cardíaco devido a um abraço muito apertado",
            "Asfixia por bolo de aniversário surpresa",
            "Explosão cerebral causada por piadas ruins",
            "Afogamento em lágrimas de tanto rir",
            "Ataque de pânico ao ver um pato muito assustador",
            "Sufocamento por abraçar um unicórnio",
            "Colapso após ouvir um trocadilho extremamente ruim",
            "Combustão espontânea por excesso de felicidade",
            "Acidente fatal com um sorriso largo demais",
            "Envenenamento por brigadeiro adulterado",
            "Lesão crítica ao tentar imitar um gato ninja",
            "Esgotamento por excesso de bocejos em uma reunião entediante",
            "Ataque de riso ao tentar pronunciar palavras complicadas",
            "Sufocamento por uma risada snort excessivamente alta",
            "Colapso durante uma competição de quem faz a careta mais engraçada",
            "Inanição devido a uma dieta de marshmallows",
            "Explosão de alegria por encontrar um cachorro muito fofo",
            "Parada cardíaca causada por surpresa de um presente de gato",
            "Lesão crítica por uma dança muito animada",
            "Ataque de riso enquanto assistia a um vídeo de gatos",
            "Sufocamento com um abraço virtual muito apertado",
            "Morte súbita ao descobrir que as vacas podem voar",
            "Parada cardíaca por overdose de abraços de urso",
            "Colapso ao tentar equilibrar uma colher no nariz",
            "Sufocamento por engolir uma risada enquanto bebia água",
            "Explosão de alegria ao receber um emoji especialmente engraçado",
            "Lesão fatal ao tentar fazer um mortal para trás na cama elástica",
            "Ataque de riso ao ver um pato vestido de pinguim",
            "Combustão espontânea após contar piadas até o infinito",
            "Parada cardíaca por receber um elogio surpreendente",
            "Afogamento em uma poça de lágrimas de felicidade",
            "Lesão crítica ao dançar polka em um piso recémencerado",
            "Asfixia por uma gargalhada fora de controle",
            "Combustão espontânea ao ver um filme extremamente engraçado",
            "Parada cardíaca ao descobrir que as galinhas podem atravessar a estrada",
            "Afogamento em um banho de risadas",
            "Morte por excesso de abraços virtuais",
            "Colapso após uma overdose de humor absurdo",
            "Lesão crítica ao tentar equilibrar uma colher no nariz",
            "Sufocamento com uma pluma durante uma guerra de travesseiros",
            "Combustão espontânea devido a uma piada de humor quântico",
            "Parada cardíaca ao descobrir que as girafas são astronautas em segredo",
            "Afogamento em um mar de piadas de dad bod",
            "Lesão fatal ao tentar imitar o moonwalk de Michael Jackson",
            "Explosão de alegria por ganhar um concurso de caretas",
            "Parada cardíaca após assistir a um desfile de patinhos fofos"
        ];        
        
        return "@" . $request->nome . " foi de F por: " . $causas_de_morte_engracadas[rand(0, 47)];
    }

    public function barata(Request $request) {
        $nomes = explode(',', $request->args);
        $nomes = array_map('trim', $nomes);
        $nomes = array_filter($nomes);

        if(count($nomes) == 0) {
            return $this->barataTutorial();
        }

        $escolhido = $nomes[rand(0, count($nomes) - 1)];
        return 'Toda vez que eu chego em casa, A barata da vizinha está na minha cama, Toda vez que eu chego em casa, A barata da vizinha está na minha cama, Diz aí ' . $escolhido . ' o que cê vai fazer?';
    }

    public function respBarata(Request $request) {
        $mensagem = $request->msg;
        $mensagem = str_replace('!', '', $mensagem);
        return 'Ele vai ' . $mensagem . ' na barata dela, Ele vai ' . $mensagem . ' na barata dela, Ele vai ' . $mensagem . ' na barata dela, Ele vai ' . $mensagem . ' na barata dela!';
    }

    public function respBarataTutorial() {      
        return 'Você esqueceu de digitar a mensagem!';
    }

    public function barataTutorial() {
        return 'Para o comando funcionar, você deve escrever nome de pessoas ou usuários depois do comando separados por vírgulas!';
    }
}

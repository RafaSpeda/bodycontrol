# BodyControl - Gerenciamento de Banco de Dados com PHP

## DESCRIÇÃO
A aplicação web **BodyControl** foi desenvolvida para demonstrar a integração de um banco de dados funcional com um site, utilizando PHP. O projeto tem como objetivo fornecer uma interface simples e intuitiva para os usuários, além de garantir **segurança no desenvolvimento**, minimizando vulnerabilidades, como **SQL Injection**. A aplicação está totalmente funcional, e com pequenos ajustes nas configurações do banco de dados, pode ser utilizada por empresários e entusiastas do esporte em todo o Brasil.

## FUNCIONALIDADES
- **Página inicial**: Apresenta um sistema de redirecionamento para que o usuário possa escolher entre acessar a área de *login*, *matricular* um novo aluno ou *consultar* os dados dos alunos já cadastrados.
- **Área de login**: Permite ao usuário inserir suas credenciais de acesso para realizar o login no sistema.
- **Cadastro de aluno**: O campo *Matricular* permite registrar um novo aluno no sistema.
- **Consulta de dados**: Na área *Consultar*, o usuário pode visualizar todos os alunos cadastrados ou filtrar os registros por nome, CPF ou celular.

### FUNCIONALIDADES DE SEGURANÇA
A segurança dos dados foi priorizada no desenvolvimento do site, com a implementação dos seguintes mecanismos:

- **Senhas criptografadas**:
  - As senhas dos usuários são armazenadas de forma segura no banco de dados utilizando o algoritmo bcrypt.
  - A função `password_hash()` é utilizada para criptografar as senhas, enquanto a função `password_verify()` garante a comparação segura durante a autenticação.

- **Proteção contra SQL Injection**:
  - O sistema utiliza *prepared statements* em todas as consultas SQL, o que impede ataques de SQL Injection.
  - As variáveis inseridas nos formulários são adequadamente escapadas com a função `real_escape_string()` para evitar falhas de codificação ou interpretação incorreta dos dados.

- **Sessões seguras**:
  - As informações do usuário autenticado são armazenadas em sessões, garantindo a persistência da autenticação ao longo da navegação.
  - A gestão das sessões é feita com boas práticas de segurança, como o uso de variáveis de sessão seguras e a prevenção contra sequestro de sessões.

## TECNOLOGIAS UTILIZADAS
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Banco de dados**: MySQL/MariaDB

## PREPARANDO O AMBIENTE

### Configuração do Sistema Usando XAMPP

1. **Baixar o XAMPP**:
   - Acesse o [site oficial do XAMPP](https://www.apachefriends.org/pt_br/index.html).
   - Selecione a versão apropriada para o seu sistema operacional (Windows, Linux, macOS).
   - Faça o download e execute o instalador.

2. **Instalar o XAMPP**:
   - Após o download, execute o instalador do XAMPP.
   - Selecione os componentes que deseja instalar (Apache, MySQL, PHP, etc.).
   - Escolha o diretório de instalação e siga as instruções do assistente.

3. **Iniciar o XAMPP**:
   - Abra o XAMPP Control Panel.
   - Clique em "Start" nos serviços Apache e MySQL para iniciar o servidor web e o banco de dados.

4. **Configurar o Ambiente de Desenvolvimento**:
   - O XAMPP cria uma pasta chamada `htdocs`, onde você deve colocar os arquivos do seu site.
   - Copie o seu projeto para a pasta `htdocs` (geralmente localizada em *C:\xampp\htdocs* no Windows ou /opt/lampp no Linux).
   - Abra o navegador e digite `localhost` ou `127.0.0.1` para verificar se o Apache está funcionando corretamente.

### GIT CLONE
Clone o repositório com o seguinte comando:
```bash
git clone https://github.com/RafaSpeda/bodycontrol.git
```
## DATABASE SCHEMA
Abra seu gerenciador de banco de dados (como MySQL Workbench ou DBeaver) e execute o script presente em:
``academia.sql``

## ACESSANDO
Após configurar o ambiente, adicione os arquivos à pasta htdocs e acesse a aplicação através de http://localhost/academia/pages/ para explorar as funcionalidades da ferramenta.

### CREDENCIAIS
As credenciais de login são:
- **E-mail:** suaacademia@bodycontrol.com
- **Senha:** senha_secreta

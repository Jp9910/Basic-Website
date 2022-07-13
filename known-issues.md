1. Caracteres especiais como "<" e ">" estão sendo transformados em ASCII.
e quando inserido como ASCII, são filtrados pra fora

2. Quando o usuário alterar o próprio usuário, é preciso destruir a sessão.

3. No cadastro de filiados, é preciso tratar o input para não permitir fazer o post caso
o cpf, rg, telefone, celular, não seja composto por números (permitir "." e "-"?)

4. Permissao de acessar as rotas quando não estiver logado/!isAdmin deveria dar um feedback ou
redirecionar para a página de login

5. Limitar a paginação pegando o número total de linhas de certa tabela.
INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES (NULL, 'TESTE BD');
INSERT INTO `administrador` (`id_administrador`, `nome_administrador`, `cpf_administrador`, `senha_administrador`, `email_administrador`) VALUES (NULL, 'Luis Pimenta', '02342288140', '123456', 'luisfelipearaujopimenta@gmail.com');
INSERT INTO `noticia` (`id_noticia`, `titulo_noticia`, `texto_noticia`, `data_noticia`, `id_categoria`, `status_noticia`) VALUES (NULL, 'TESTE BD', '2', current_timestamp(), '1', '1');

<script src="{{ asset('assets/js/menu.js') }}"></script>
<footer id="footer">
    <div class="footer">
        <p>Todos os direitos reservados. <a href="#">LEGENDZGG.COM</a> não possuí qualquer vínculo ou afiliação
            com © Riot Games, Inc. Riot Games, League of Legends e PvP.net que são marcas registradas e marcas
            de serviço da Riot Games, Inc.</p>
    </div>

</footer>
<div class="modal " id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true" style="display: none">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Realizar Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal" id="formLogin" method="POST" name="login" action="{{ route('jogador.auth.login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <br/>
                    <br/>
                    <div class="form-group{{ $errors->has('authError') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-mail* </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required >
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('authError') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Senha *</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required minlength="6">


                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" id="login">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
                <div class="footer-cadastro">
                    <a class="btn btn-link" href="{{ route('jogador.email') }}">
                            Esqueceu sua senha ?
                        </a>
                     <a class="btn btn-link" href="{{ url('cadastro') }}">
                            Criar cadastro
                        </a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="logoutModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <button type="button" class="close" style="margin-top: 0 !important;" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Atenção</h4>
            </div>
            <div class="modal-body">
                <div id="ezAlerts-message" style="color:#000;font-size:18px;">Deve estar logado para acessar o Suporte!</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>

</div>
<script>
    $(function(){
        $("#formLogin").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages:{
                email:{
                    required: "Email obrigatório",
                    email:  "Precisa ser um e-mail  verdadeiro"
                },
                password:{
                    required: "Senha obrigatório ",
                    minlength:  "Sua senha precisar ser maior que 6"
                }

            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $('#loginModal').on('hidden.bs.modal', function () {
            var validator = $( "#formLogin" ).validate();
            validator.resetForm();
        })
    });
</script>
        <footer class="footer"> 
          <div class="container-fluid">
            <div class="row"> 
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">{{__('footer.copyright').' '.date('Y')}}</p>
              </div>
              <div class="col-md-6">
                <p class="float-end mb-0">
                  {{__('footer.handcrafted').' '.__('Karam Maarouf')}}
                  <svg class="svg-color footer-icon">
                    <use href="{{ asset('assets/svg/iconly-sprite.svg#heart') }}"></use>
                  </svg>
                </p>
              </div>
            </div>
          </div>
        </footer>
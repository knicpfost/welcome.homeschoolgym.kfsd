jQuery(function(){
thetheImageSlider = function(){
	this.nID				= null;
	this.currentIndex		= 0;
	this.nextIndex			= 1;
	this.slideLength		= 0;
	this.arrSlides			= [];
	this.arrSParams			= [];
	this.defaultInterval	= 4000;
	this.defaultSlideT		= 500;

	this.nHeight			= 313;
	this.nWidth				= 500;
	this.bAutoplay			= true;
	
	this.arrBlocks			= [];
	this.arrNextBlocks		= [];
	this.blockType			= '';
	this.arrCurrentBlock	= {x: 0, y: 0};
	this.bPlay				= true;
	this.arrThumbs			= []
	this.arrBMinCol			= {
		width : 6,
		height : 5
	}
	this.arrF				= {step : 1, x : 0, y : 0, sight : 1}
	this.arrBParams			= {
		rows : 0,
		cols : 0,
		width : 0,
		height : 0,
		bcount : 0,
		bworkd : 0
	}
	this.nBlockCols			= 0;
	this.bBlockRows			= 0;
	this.cTimeout			= null;
	this.nImagesLoaded		= 0;
	this.loader				= null;
	this.loaderProgress		= null;
	this.strSkin			= '';
	this.bLoop				= true;
	this.bNextSlide			= false;
	this.bAction			= false;

	this.play = function(prev){
		this.bPlay = true;
		if(this.cTimeout){
			clearTimeout(this.cTimeout)
		}
		this.transition(prev);
	}
	
	this.pause = function(){
		if(	this.bPlay == true ){
			this.stop();
			return 'stopped';
		}else{
			this.play();
			return 'played';
		}
	}
	
	this.goNext = function(){
		bPlay = this.bPlay;
		this.play();
		this.bPlay = bPlay;
	}
	
	this.goPrevious = function(){
		bPlay = this.bPlay;	
		this.nextIndex -= 2;
		//this.currentIndex -= 1;
		if(this.nextIndex < 0){
			this.nextIndex = this.slideLength-1;
		}
		if(this.currentIndex < 1){
			//this.currentIndex = 1;
		}
		this.bPlay = true;
		if(this.cTimeout){
			clearTimeout(this.cTimeout)
		}
		this.play(1);
		this.bPlay = bPlay;
	}
	
	this.stop = function(){
		this.bPlay = false;
	}
	
	this.currentBlock = function(){		
		if(oMoz = jQuery(this.arrSlides[this.currentIndex - 1]).children('.thethe-image-slider-blocks')){
			if(oMoz.attr('class') != undefined){
				return oMoz;
			}
		}
		return jQuery(this.arrSlides[this.currentIndex - 1]).append('<div class="thethe-image-slider-blocks"></div>').children('.thethe-image-slider-blocks');
	}
	
	this.nextBlock = function(){		
		return jQuery(this.arrSlides[this.nextIndex - 1]).append('<div class="thethe-image-slider-blocks"></div>').children('.thethe-image-slider-blocks');
	}
	
	this.currentNotice = function(state){
		if(!state){
			jQuery(this.arrSlides[this.currentIndex - 1]).children('.thethe-image-slider-caption').hide();
		}else{
			jQuery(this.arrSlides[this.currentIndex - 1]).children('.thethe-image-slider-caption').fadeIn(this.defaultSlideT);
		}
	}
	
	this.nextNotice = function(state){
		if(!state){
			jQuery(this.arrSlides[this.nextIndex - 1]).children('.thethe-image-slider-caption').hide();
		}else{
			jQuery(this.arrSlides[this.nextIndex - 1]).children('.thethe-image-slider-caption').fadeIn(this.defaultSlideT);
		}
	}
	
	this.currentImg = function(){
		return jQuery(this.arrSlides[this.currentIndex - 1]).children('.thethe-image-slider-image');
	}
	
	this.nextImg = function(){
		return jQuery(this.arrSlides[this.nextIndex - 1]).children('.thethe-image-slider-image');
	}
	
	this.current = function(){
		return jQuery(this.arrSlides[this.currentIndex - 1]);
	}
	
	this.next = function(){
		return jQuery(this.arrSlides[this.nextIndex - 1]);
	}
	
	this.transitionEnd = function(){
		this.clean();
		this.currentNotice(false);
		this.nextNotice(true);
		this.arrBlocks = []		
		this.bAction = false;
	}
	
	this.restoreCurrentImg = function(){
		this.currentImg()
			.css({width : this.nWidth, height : this.nHeight, opacity : 1})
	}
	
	this.restoreNextImg = function(){
		this.nextImg()
			.css({width : this.nWidth, height : this.nHeight, opacity : 1})
	}
	
	this.slideLeft = function(){
		var t = this;			
		t.next()
			.addClass('show')
			.css({marginLeft : -this.nWidth + 'px'})
			.animate({ marginLeft : 0 + 'px'}, this.defaultSlideT)
		
		t.current()
			.animate({ marginLeft : this.nWidth}, this.defaultSlideT-20, function(){t.transitionEnd()})
	}
	
	this.slideRight = function(){
		var t = this;
		t.current()
			.animate({ marginLeft : -this.nWidth}, this.defaultSlideT)
			
		t.next()
			.addClass('show')
			.css({marginLeft : this.nWidth + 'px'})
			.animate({ marginLeft : 0 + 'px'}, this.defaultSlideT-20, function(){t.transitionEnd()})
	}
	
	this.slideTop = function(){
		var t = this;			
		t.next()
			.addClass('show')
			.css({marginTop : -this.nHeight + 'px'})
			.animate({ marginTop : 0 + 'px'}, this.defaultSlideT)
		
		t.current()
			.animate({ marginTop : this.nHeight}, this.defaultSlideT-20, function(){t.transitionEnd()})
			
	}
	
	this.slideBottom = function(){
		var t = this;
		t.next()
			.addClass('show')
			.css({marginTop : this.nHeight + 'px'})
			.animate({ marginTop : 0 + 'px'}, this.defaultSlideT)
			
		t.current()
			.animate({ marginTop : -this.nHeight}, this.defaultSlideT-20, function(){t.transitionEnd()})
	}
	
	this.slideAndBounceTop = function(){
		var t = this;
		t.current()
			.animate({ marginTop : this.nHeight}, this.defaultSlideT)
			
		t.next()
			.addClass('show')
			.css({marginTop : -this.nHeight + 'px'})
			.animate({ marginTop : 80 + 'px'}, this.defaultSlideT)
			.animate({ marginTop : -50 + 'px'}, this.defaultSlideT/2)
			.animate({ marginTop : 20 + 'px'}, this.defaultSlideT/2)
			.animate({ marginTop : 0 + 'px'}, this.defaultSlideT/2, function(){t.transitionEnd()})
	}
	
	this.slideAndBounceRight = function(){
		var t = this;
		t.current()
			.animate({ marginLeft : -this.nWidth}, this.defaultSlideT)
			
		t.next()
			.addClass('show')
			.css({marginLeft : this.nWidth + 'px'})
			.animate({ marginLeft : -80 + 'px'}, this.defaultSlideT)
			.animate({ marginLeft : 50 + 'px'}, this.defaultSlideT/2)
			.animate({ marginLeft : -20 + 'px'}, this.defaultSlideT/2)
			.animate({ marginLeft : 0 + 'px'}, this.defaultSlideT/2, function(){t.transitionEnd()})
	}
	
	this.slideAndBounceLeft = function(){		
		var t = this;
		t.current()
			.animate({ marginLeft : this.nWidth}, this.defaultSlideT)
			
		t.next()
			.addClass('show')
			.css({marginLeft : -this.nWidth + 'px'})
			.animate({ marginLeft : 80 + 'px'}, this.defaultSlideT)
			.animate({ marginLeft : -50 + 'px'}, this.defaultSlideT/2)
			.animate({ marginLeft : 20 + 'px'}, this.defaultSlideT/2)
			.animate({ marginLeft : 0 + 'px'}, this.defaultSlideT/2, function(){t.transitionEnd()})
		
	}
	
	this.slideAndBounceBottom = function(){
		var t = this;
		t.current()
			.animate({ marginTop : -this.nHeight}, this.defaultSlideT)
			
		t.next()
			.addClass('show')
			.css({marginTop : this.nHeight + 'px'})
			.animate({ marginTop : -80 + 'px'}, this.defaultSlideT)
			.animate({ marginTop : 50 + 'px'}, this.defaultSlideT/2)
			.animate({ marginTop : -20 + 'px'}, this.defaultSlideT/2)
			.animate({ marginTop : 0 + 'px'}, this.defaultSlideT/2, function(){t.transitionEnd()})
		
	}
	
	this.scaleCenter = function(){
		var t = this;
		t.current()
			.animate({ height: 0, width : 0, marginLeft : t.nWidth/2, marginTop : t.nHeight/2, opacity : 0}, t.defaultSlideT, 
				function(){
					t.next()	
						.css({ height: 0, width : 0, marginLeft : t.nWidth/2,  marginTop : t.nHeight/2, opacity : 0})
						.addClass('show')
						.animate({height: t.nHeight, width : t.nWidth, marginLeft : 0,  marginTop : 0,  opacity : 1}, t.defaultSlideT);
			})
			
		t.currentImg()
			.animate({ height: 0, width : 0}, t.defaultSlideT, 
				function(){
					t.restoreCurrentImg();
					t.nextImg()	
						.css({ height: 0, width : 0})
						.animate({height: t.nHeight, width : t.nWidth}, t.defaultSlideT, function(){t.transitionEnd()})
				}
			)
	}
	
	this.flip = function(){
		var t = this;
		t.current()
			.animate({ width : 0 + 'px', marginLeft : t.nWidth/2 + 'px'}, t.defaultSlideT, 
				function(){
					t.next()
						.css({ width : 0 + 'px', marginLeft : t.nWidth/2  + 'px', opacity : 0.5})
						.addClass('show')
						.animate({width : t.nWidth + 'px', marginLeft : 0 + 'px',  opacity : 1}, t.defaultSlideT);
			})
		t.currentImg()
			.animate({ width : 0 + 'px'}, t.defaultSlideT, 
				function(){
					t.restoreCurrentImg();
					t.nextImg()	
						.css({ width : 0 + 'px'})
						.animate({ width : t.nWidth + 'px'}, t.defaultSlideT, function(){t.transitionEnd()})
				}
			)
	}
	
	this.scaleTop = function(){
		var t = this;
		t.current()
			.animate({ height: 0, width : 0, marginLeft : t.nWidth/2, marginTop : -t.nHeight, opacity : 0}, t.defaultSlideT, 
				function(){
					t.next()	
						.css({ height: 0, width : 0, marginLeft : t.nWidth/2,  marginTop : t.nHeight, opacity : 0})
						.addClass('show')
						.animate({height: t.nHeight, width : t.nWidth, marginLeft : 0,  marginTop : 0,  opacity : 1}, t.defaultSlideT);
			})
			
		t.currentImg()
			.animate({ height: 0, width : 0}, t.defaultSlideT, 
				function(){
					t.nextImg()	
						.css({ height: 0, width : 0})
						.animate({height: t.nHeight, width : t.nWidth}, t.defaultSlideT, function(){t.transitionEnd()})
				}
			)
	}
	
	this.zoom = function(){
		var t = this;
		multip = 10;
		t.current()
			.animate({ marginLeft : -(t.nWidth * multip/2), width : (t.nWidth * multip), height : (t.nHeight * multip), marginTop : -(t.nHeight * multip/2) }, t.defaultSlideT, 
				function(){
					t.next()	
						.css({ marginLeft : -(t.nWidth * multip/2), width : (t.nWidth * multip), height : (t.nHeight * multip), marginTop : -(t.nHeight * multip/2) })
						.addClass('show')
						.animate({marginLeft : 0,  marginTop : 0, height : t.nHeight, width : t.nWidth}, t.defaultSlideT);
			})
			
		t.currentImg()
			.animate({ height: t.nHeight*multip, width : t.nWidth*multip }, t.defaultSlideT, 
				function(){
					t.nextImg()	
						.css({ height: t.nHeight * multip, width : t.nWidth * multip })
						.animate({height: t.nHeight, width : t.nWidth}, t.defaultSlideT, function(){t.transitionEnd()})
				}
			)
	}
	
	this.scaleAndSlide = function(){		
		this.currentNotice(false);
		this.nextNotice(false);
		var t = this;
		t.current()
			.animate({ height: this.nHeight/5, width : this.nWidth/5, marginLeft : ((this.nWidth-this.nWidth/5)/2), marginTop : (this.nHeight-this.nHeight/5)/2, opacity : 0.5}, this.defaultSlideT, 
				function(){
					t.current()
						.animate({ marginLeft : (-t.nWidth)/5}, t.defaultSlideT, 
						function(){
							t.next()
								.css({ height: t.nHeight/5, width : t.nWidth/5, marginLeft : t.nWidth + 'px' ,  marginTop : (t.nHeight-t.nHeight/5)/2, opacity : 0.5})
								.addClass('show')
								.animate({ marginLeft : ((t.nWidth-t.nWidth/5)/2)}, t.defaultSlideT, 
								function(){
									t.next()
										.animate({height: t.nHeight, width : t.nWidth, marginLeft : 0,  marginTop : 0,  opacity : 1}, t.defaultSlideT);
									
									t.nextImg()
										.animate({height: t.nHeight, width : t.nWidth}, t.defaultSlideT, function(){t.transitionEnd()});
								})
							t.nextImg()	
									.css({ height: t.nHeight/5, width : t.nWidth/5})
						})
			})
		t.currentImg()
			.animate({ height: this.nHeight/5, width : this.nWidth/5}, this.defaultSlideT)
	}
	
	this.fade = function(){
		var t = this;
		t.current()
			.animate({ opacity : 0}, this.defaultSlideT);
		t.next()		
			.css({opacity: 0})
			.addClass('show')
			.animate({ opacity : 1}, this.defaultSlideT, function(){t.transitionEnd()})
			
	}
	
	this.makeSquares = function(){
		this.arrBlocks = []
		s = this.currentBlock();
		n = this.arrBMinCol.width;
		while(n < 30){
			if(!(this.nWidth % n)){
				this.arrBParams.width = this.nWidth / n;
				this.arrBParams.rows = n;
				break;
			}
			n++;
		}		
		if(!this.arrBParams.rows){			
			this.arrBParams.width = Math.floor(this.nWidth / this.arrBMinCol.width);
			this.arrBParams.rows = this.arrBMinCol.width + 1;
		}
		
		n = this.arrBMinCol.height;
		while(n < 30){
			if(!(this.nHeight % n)){
				this.arrBParams.height = this.nHeight / n;
				this.arrBParams.cols = n;
				break;
			}
			n++;
		}
		if(!this.arrBParams.cols){			
			this.arrBParams.height = Math.floor(this.nHeight / this.arrBMinCol.height);
			this.arrBParams.cols = this.arrBMinCol.height + 1;
		}
		this.arrBParams.bcount = this.arrBParams.cols * this.arrBParams.rows;
		this.arrBParams.bworkd = 0;
				
		this.arrCurrentBlock.x = 0;
		this.arrCurrentBlock.y = 0;
		
		for(y = 0; y < this.arrBParams.cols; y++ ){
			for( x = 0; x < this.arrBParams.rows ; x++ ){
				var _oDiv = document.createElement('DIV');
				_oDiv.className = 'thethe-image-slider-block';
				_oDiv.style.width = this.arrBParams.width + 'px';
				_oDiv.style.height = this.arrBParams.height + 'px';
				_oDiv.style.backgroundImage = 'url(' + this.currentImg().attr('src') + ')';
				_oDiv.style.backgroundPosition = '-' + (x * this.arrBParams.width) + 'px ' + '-' + (y * this.arrBParams.height) + 'px';
				s.append(jQuery(_oDiv));
				if(!this.arrBlocks[y]){
					this.arrBlocks[y] = []
				}
				this.arrBlocks[y][x] = _oDiv;
			}
		}
	}
	
	this.makeRows = function(){		
		s = this.currentBlock();
		n = this.arrBMinCol.width;
		
		n = this.arrBMinCol.height;
		while(n < 10){
			if(!(this.nHeight % n)){
				this.arrBParams.height = this.nHeight / n;
				this.arrBParams.cols = n;
				break;
			}
			n++;
		}
		if(!this.arrBParams.cols){			
			this.arrBParams.height = Math.floor(this.nHeight / this.arrBMinCol.height);
			this.arrBParams.cols = this.arrBMinCol.height + 1;
		}
		this.arrBParams.bcount = this.arrBParams.cols;
		this.arrBParams.bworkd = 0;

		this.arrCurrentBlock.y = 0;
		
		for(y = 0; y < this.arrBParams.cols; y++ ){
			var _oDiv = document.createElement('DIV');
			_oDiv.className = 'thethe-image-slider-row';
			_oDiv.style.height = this.arrBParams.height + 'px';
			_oDiv.style.top = (y * this.arrBParams.height) + 'px'
			_oDiv.style.backgroundImage = 'url(' + this.currentImg().attr('src') + ')';
			_oDiv.style.backgroundPosition = '0px -' + (y * this.arrBParams.height) + 'px';
			s.append(jQuery(_oDiv));
			if(!this.arrBlocks[y]){
				this.arrBlocks[y] = _oDiv
			}
		}
	}
	
	this.block = function(x, y){
		if(x == undefined || y == undefined){
			x = this.arrCurrentBlock.x;
			y = this.arrCurrentBlock.y;
		}
		if(!this.arrBlocks[y] || !this.arrBlocks[y][x]){
			return false;
		}
		return jQuery(this.arrBlocks[y][x]);
	}
	
	this._setTimeout = function(n, pos, bLast){
		t = this;
		setTimeout(
			function(){
				t._moveRow(n, pos, bLast);
			}
			, (100 * ((pos == 'top') ? ((parseInt(t.arrBlocks.length - 1 - n))) : n ))
		)
	}
	
	this._moveRow = function(n, pos, bLast){
		if(pos == 'sides'){
			if(n%2){
				pos = 'right';
			}else{
				pos = 'left';
			}
		}
		if(pos == 'left'){
			jQuery(this.arrBlocks[n])
				.animate({left : -this.nWidth + 'px'}, (this.defaultSlideT), function(){
					if(bLast){
						t.transitionEnd();
					}
				});
		}else if(pos == 'right'){
			jQuery(this.arrBlocks[n])
				.animate({left : this.nWidth + 'px'}, (this.defaultSlideT), function(){
					if(bLast){
						t.transitionEnd();
					}
				});
		}else if(pos == 'top'){
			jQuery(this.arrBlocks[n])
				.animate({top : -this.nHeight + 'px'}, (this.defaultSlideT), function(){
					if(bLast){
						t.transitionEnd();
					}
				});
		}else if(pos == 'bottom'){
			jQuery(this.arrBlocks[n])
				.animate({top : this.nHeight + 'px'}, (this.defaultSlideT / (n+1)), function(){
					if(bLast){
						t.transitionEnd();
					}
				});
		}
	}
	
	this.rowsto = function(pos){
		for(i = 0 ; i < this.arrBlocks.length; i++){			
			this._setTimeout(i, pos, (i == parseInt(this.arrBlocks.length)-1) ? true : false)
		}
	}
	
	this.moveRows = function(type){
		this.makeRows();
		this.current()
			.css({'z-index' : 4})
		this.next()
			.css({'z-index' : 3})
			.addClass('show');
		this.currentNotice(false);
		this.currentImg().css({opacity:0});
		this.rowsto(type);
	}
	
	this.nextSlide = function(){		
		var tn = this;
		if(this.arrThumbs[this.currentIndex-1]){
			jQuery(this.arrThumbs[this.currentIndex-1]).removeClass('thethe-image-slider-thumbnails-currentthumb');
		}
		if(!this.checkBorders()){
			return
		}
		nTime = this.defaultInterval;
		nI = this.currentIndex
		if(nI >= this.slideLength){
			nI=0;
		}
		if(this.arrSParams[nI].time){
			nTime = this.arrSParams[nI].time
		}
		tn.cTimeout = setTimeout(function(){tn.transition()}, nTime)
	}
	
	this.clean = function(){
		this.current()
			.css({width : this.nWidth, height : this.nHeight, opacity : 1, marginLeft : 0, marginTop : 0, 'z-index' : 3})
			.removeClass('show');
		
		this.next()
			.css({width : this.nWidth, height : this.nHeight, opacity : 1, marginLeft : 0, marginTop : 0, 'z-index' : 3})
		this.restoreCurrentImg();
		this.restoreNextImg();
		if(oMoz = this.current().children('.thethe-image-slider-blocks')){
			if(oMoz.attr('class') != undefined){
				oMoz.html('');
			}
		}
		this.currentNotice(false);
		this.nextNotice(false);
		next = parseInt(this.currentIndex) + 1;
		if(next > this.slideLength){
			next -= this.slideLength;
		}
		if(next != this.nextIndex){
			this.currentIndex = this.nextIndex - 1;
			this.nextIndex = this.currentIndex + 1;
			if(this.nextIndex > this.slideLength){
				this.nextIndex = 1;
			}
		}
	}
	
	this._transition = function(effect){
		this.bAction = true;
		switch(effect){
			case 'fade':
				this.fade();
				break;
			case 'slidenbouncetop':
				this.slideAndBounceTop();
				break;
			case 'slidenbounceright':
				this.slideAndBounceRight();
				break;
			case 'slidenbounceleft':
				this.slideAndBounceLeft();
				break;
			case 'slidenbouncebottom':
				this.slideAndBounceBottom();
				break;
			case 'slidetop':
				this.slideTop();
				break;
			case 'slideright':
				this.slideRight();
				break;
			case 'slideleft':
				this.slideLeft();
				break;
			case 'slidebottom':
				this.slideBottom();
				break;
			case 'scalecenter':
				this.scaleCenter();
				break;
			case 'scaletop':
				this.scaleTop();
				break;
			case 'scalenslide':
				this.scaleAndSlide();
				break;
			case 'zoom':
				this.zoom();
				break;
			case 'flip':
				this.flip();
				break;
			case 'rowssides':
				this.moveRows('sides');
				break;
			case 'rowsleft':
				this.moveRows('left');
				break;
			case 'rowsright':
				this.moveRows('right');
				break;
			case 'rowstop':
				this.moveRows('top');
				break;
			case 'rowsbottom':
				this.moveRows('bottom');
				break;
			case 'random':
				arrVars = ['fade', 'slidetop', 'slideright', 'slideleft', 'slidebottom', 'slidenbouncetop', 'slidenbounceright', 'slidenbounceleft', 'slidenbouncebottom', 'scalecenter', 'scaletop', 'scalenslide', 'zoom', 'flip','rowstop','rowsbottom','rowsleft','rowsright','rowssides'];
				nEff = Math.floor( Math.random( ) * (arrVars.length) );
				this._transition(arrVars[nEff]);
				break;
			default:
				this.fade();
				break;
		};
		jQuery(this.arrThumbs[this.nextIndex-1]).addClass('thethe-image-slider-thumbnails-currentthumb');
	}
	
	this.transition = function(prev){
		if(!this.bPlay){
			return false;
		}
		if(!this.checkIfPossible()){
			return
		}
		//this.clean();
		this.nextIndex += 1;
		this.currentIndex += 1;
		if(this.nextIndex > this.slideLength){
			this.nextIndex = 1;
		}
		if(this.currentIndex > this.slideLength){
			this.currentIndex = 1;
		}
		if (prev){ 
			index = ((this.currentIndex-2) < 0) ? (this.slideLength-1) : (this.currentIndex-2);
			this._transition(this.arrSParams[index].transition);
		} else {
			this._transition(this.arrSParams[this.currentIndex-1].transition);
		}
		if(this.bPlay){
			this.nextSlide();
		}
	}
	
	this.checkBorders = function(){
		if(this.bLoop){
			return true;
		}
		if(this.nextIndex == 1){			
			jQuery('#' + this.nID + '-previous').css('margin-left','-1000px');			
		}else{			
			jQuery('#' + this.nID + '-previous').css('margin-left','0px');			
		}
		if(this.nextIndex == this.slideLength){
			jQuery('#' + this.nID + '-next').css('margin-right','-1000px');
			this.bPlay = false;
			jQuery('#' + this.nID + '-pause').removeClass('thethe-pause');
			jQuery('#' + this.nID + '-pause').addClass('thethe-play');
			return false;
		}else{
			jQuery('#' + this.nID + '-next').css('margin-right','0px');
		}
		return true;
	}
	
	this.checkIfPossible = function(){
		this.bNextSlide = true;
		return !this.bAction;
	}
	
	this.activateSlide = function(key, thumb){
		if(key == this.nextIndex){
			return false;
		}
		if(!this.checkIfPossible()){
			jQuery(thumb).removeClass('thethe-image-slider-thumbnails-currentthumb');
			if(this.arrThumbs[this.nextIndex-1]){
				jQuery(this.arrThumbs[this.nextIndex-1]).addClass('thethe-image-slider-thumbnails-currentthumb');
			}
			return
		}
		if(this.cTimeout){
			clearTimeout(this.cTimeout)
		}
		this.clean();
		this.currentIndex = this.nextIndex;
		this.nextIndex = key;
		
		this.checkBorders();
		this._transition(this.arrSParams[this.currentIndex-1].transition);		
		if(this.bPlay){
			this.nextSlide();
		}
	}
	
	this.readSliderSettings = function(){
		var t = this;
		jQuery('#' + this.nID + ' .thethe-image-slider-settings span').each(
			function(){
				switch(jQuery(this).attr('class')){
					case 'width':
						t.nWidth = parseInt(jQuery(this).text());
						break;
					case 'height':
						t.nHeight = parseInt(jQuery(this).text());
						break;
					case 'skin':
						t.strSkin = jQuery(this).html();
						break;
					case 'loop':
						if(jQuery(this).html() == 'false'){
							t.bLoop = false;
						}
						break;
					case 'autoplay':
						if(jQuery(this).html() == 'false'){
							t.bAutoplay = false;
						}
						break;
					case 'trans-time':
						t.defaultSlideT = parseInt(jQuery(this).text());
						break;						
						
				}
			}
		)
		jQuery('#' + this.nID + ' .thethe-image-slider-settings').remove();
		return true;
	}

	this.readSlideSettings = function(key){
		var t = this;
		var nkey = key,
			$slideSettings = jQuery(t.arrSlides[nkey]).children('.thethe-image-slider-slide-settings');
		$slideSettings.children('span').each(
			function(){
				switch(jQuery(this).attr('class')){
					case 'time':
						t.arrSParams[nkey].time = parseInt(jQuery(this).text());
						break;
					case 'transition':
						t.arrSParams[nkey].transition = jQuery(this).html();
						break;
					case 'caption-size':
						t.arrSParams[nkey].captionSize = parseInt(jQuery(this).text());
						break;
					case 'caption-position':
						t.arrSParams[nkey].captionPosition = jQuery(this).html();
						break;
					case 'caption_opacity':
						t.arrSParams[nkey].captionOpacity = parseInt(jQuery(this).text());
						break;
						
					case 'link':
						t.arrSParams[nkey].link = jQuery(this).html();
						break;
				}
			}
		)
		$slideSettings.remove();
		return true;
	}	

	this.init = function(id){
		this.nID = id;
		if(!jQuery('#'+this.nID)){
			return;
		}

		this.readSliderSettings();
		this.arrSlides = jQuery('#' + id + ' .thethe-image-slider-slides > li');
		this.slideLength = parseInt(this.arrSlides.length);
		this.loader	= jQuery('.thethe-image-slider-loader', jQuery('#' + id));
		if(this.loader){
			this.loaderProgress	= jQuery(this.loader).children('.thethe-image-slider-progress');
		}
		var t = this;
		var arrThumbs = jQuery('.thethe-image-slider-thumbnails', jQuery('#' + id));
		jQuery(this.arrSlides).each(function(key, value){
			if(!t.arrSParams[key]){
				t.arrSParams[key] = {}
			}
			oImg = jQuery(this).find('.thethe-image-slider-image');
			t.readSlideSettings(key);
			jQuery(this).css( {'width' : t.nWidth});
			jQuery(this).css( {'height' : t.nHeight});
			oImg.css( {'height' : t.nHeight});
			oImg.css( {'width' : t.nWidth});
			
			// preloader				
			jQuery('<img>').load(function(){
				++t.nImagesLoaded;
				if(t.nImagesLoaded == t.slideLength){
					t.loader.fadeOut(500,function(){
						jQuery(this).css({'display':'none','visibility':'hidden'});
					});
					if(t.bAutoplay != 0){
						t.nextSlide();
					}else{
						t.stop();
					}
				}
			}).attr('src', oImg.attr('src'));
			
			if(t.arrSParams[key].captionPosition == 'left' || t.arrSParams[key].captionPosition == 'right'){
				jQuery('.thethe-image-slider-caption', this).css({'width' : t.arrSParams[key].captionSize})
			}else{
				jQuery('.thethe-image-slider-caption', this).css({'height' : t.arrSParams[key].captionSize})
			}
			var $captionOpacity = t.arrSParams[key].captionOpacity ? 1 - t.arrSParams[key].captionOpacity/100 : 0.7;
			jQuery('.thethe-image-slider-caption-bg', this).css({'opacity' : $captionOpacity});
			
			if(t.arrSParams[key].link){
				var _link = t.arrSParams[key].link;
				jQuery(oImg).click(function(){document.location = _link})
			}
			
			if(!key){
				jQuery(this).addClass('show');
				jQuery(this).children('.thethe-image-slider-caption').show();
			}
		})
		
		jQuery(arrThumbs).append('<div class="thethe-image-slider-thumbnails-inner"></div>');
		
		var finalW = 0,
			finalH = 0;
		var arrThumbsInner = jQuery(arrThumbs).find('.thethe-image-slider-thumbnails-inner');
		
		if(arrThumbs && t.slideLength > 1){
			var tkey = 1;
			jQuery('.thethe-image-slider-thumbnails-thumb', arrThumbs).each(function(){
				jQuery(this).bind('mouseout', function(){
					jQuery(this).removeClass('thethe-image-slider-thumbnails-activated');
				})
				jQuery(this).bind('mouseover', function(){
					if(jQuery(this).attr('class').search('thethe-image-slider-thumbnails-currentthumb') == -1){
						jQuery(this).addClass('thethe-image-slider-thumbnails-activated');
					}
				})
				var _tk = tkey;
				jQuery(this).bind('click', function(){
					jQuery(this).siblings().each(function(){
						jQuery(this).removeClass('thethe-image-slider-thumbnails-currentthumb');
					})
					jQuery(this).addClass('thethe-image-slider-thumbnails-currentthumb');
					t.activateSlide(_tk, this)
				})
				finalW += jQuery(this).outerWidth(true);
				finalH = jQuery(this).outerHeight(true);
				t.arrThumbs.push(this)
				arrThumbsInner.append(jQuery(this));
				tkey++;
			})
jQuery('.thethe-image-slider-thumbnails-inner > div:first-child',arrThumbs).addClass('thethe-image-slider-thumbnails-currentthumb');
			function makeScrollable($outer, $inner){
				var extra 			= 800;
				var divWidth = $outer.width();
				$outer.css({
					overflow: 'hidden'
				});
				var lastElem = $inner.find('div:last');
				$outer.scrollLeft(0);
				$outer.unbind('mousemove').bind('mousemove',function(e){
					var containerWidth = lastElem[0].offsetLeft + lastElem.outerWidth() + 2*extra;
					var left = (e.pageX - $outer.offset().left) * (containerWidth-divWidth) / divWidth - extra;
					$outer.stop(true).animate({scrollLeft: left}, 2000);
				});
			}

			if((finalW+30) > t.nWidth){
				if(!arrThumbs.hasClass('thethe-image-slider-thumbnailsunder'))
					arrThumbs.css({'left': '0px', 'right' : '0px'});
				arrThumbsInner.css({'width': finalW+5 + 'px', 'height' : finalH +'px'});
				makeScrollable(arrThumbs,arrThumbsInner);
			}
			
		}
		
		if(this.slideLength < 2){
			return;
		}
		jQuery('#' + id + '-pause').bind('click', function(){
			if(t.pause() == 'stopped'){
				jQuery(this).removeClass('thethe-pause');
				jQuery(this).addClass('thethe-play');
			}else{
				jQuery(this).removeClass('thethe-play');
				jQuery(this).addClass('thethe-pause');
			}
			return false;
		})
		jQuery('#' + id + '-previous').bind('click', function(){
			t.goPrevious();
			return false;
		})
		jQuery('#' + id + '-next').bind('click', function(){
			t.goNext();
			return false;
		})
		if(this.strSkin != 'none'){
			jQuery('#' + id + '-pause').css({backgroundImage : 'url(' + this.strSkin + '/buttons.png)'})
			jQuery('#' + id + '-previous').css({backgroundImage : 'url(' + this.strSkin + '/buttons.png)'})
			jQuery('#' + id + '-next').css({backgroundImage : 'url(' + this.strSkin + '/buttons.png)'})
		}
		if(!this.bLoop){
			jQuery('#' + id + '-previous').css('margin-left','-1000px');
		}
		jQuery('#' + id).bind('mouseover', function(){
			jQuery('.thethe-image-slider-controls', this).css({ 'display' : 'block' })
		})
		jQuery('#' + id).bind('mouseout', function(){
			jQuery('.thethe-image-slider-controls', this).css({ 'display' : 'none' })
		})
	}
}
jQuery('.thethe_image_slider').each(function(){
	var theTheImageSlider = new thetheImageSlider();
	theTheImageSlider.init( jQuery(this).attr('id') );
});
});
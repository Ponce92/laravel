public function download($idDocumento)
	{
	      //dd($tipoDocumento);

	     if($idDocumento!=""){

			$idDocumento=Crypt::decrypt($idDocumento);   
			$documento=DocumentoSeguro::where('idDocumento',$idDocumento)->first();
	        //$urlDocumento=substr_replace($documento->urlDocumento,"V",0,1);
	        $urlDocumento=$documento->urlDocumento;
			$tipoArchivo=trim($documento->tipoDocumento);
			
			if($tipoArchivo=='application/pdf'){		
									if (File::isFile($urlDocumento))
									{

										try {
												    $file = File::get($urlDocumento);
												    $response = Response::make($file, 200);			    
												    $response->header('Content-Type', 'application/pdf');

												    return $response;
									     } catch (Exception $e) {
	                                            
											    return Response::download(trim($urlDocumento));
									     }
									}else{
										return back();
									}
			}else if($tipoArchivo=='image/png' or $tipoArchivo==='image/jpeg'){
										if (File::isFile($urlDocumento))
										{
										
										    $file = File::get($urlDocumento);
										    $response = Response::make($file, 200);
										    // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
										     $content_types = [
							                'image/png', // png etc
							                'image/jpeg', // jpeg
							                  ];
										    $response->header('Content-Type', $content_types);

										    return $response;
										}else{
											//REToRNA A LA VISTA SI NO EXISTE ESE ARCHIVO
										return back();
									    }
				}else{

								if (File::isFile($urlDocumento))
								{	
						
								    return Response::download(trim($urlDocumento));
								}
			}

		}
	}
<?php

namespace App\Form;

class Filter {
    protected ?string $breed = null ;
    protected ?bool $lof = false;


	/**
	 * @return 
	 */
	public function getBreed(): ?string {
		return $this->breed;
	}
	
	/**
	 * @param  $breed 
	 * @return self
	 */
	public function setBreed(?string $breed): self {
		$this->breed = $breed;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getLof(): ?bool {
		return $this->lof;
	}
	
	/**
	 * @param  $lof 
	 * @return self
	 */
	public function setLof(?bool $lof): self {
		$this->lof = $lof;
		return $this;
	}
}
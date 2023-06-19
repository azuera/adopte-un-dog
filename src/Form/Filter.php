<?php

namespace App\Form;
use App\Entity\Breed;

class Filter {
    protected ?Breed $breed = null;
    protected ?bool $lof = false;

	/**
	 * @return 
	 */
	public function getBreed(): ?Breed {
		return $this->breed;
	}
	
	/**
	 * @param  $breed 
	 * @return self
	 */
	public function setBreed(?Breed $breed): self {
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
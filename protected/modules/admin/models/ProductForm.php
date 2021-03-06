<?php

/**
 * ProductForm class.
 * ProductForm is the data structure for keeping
 * product form data. It is used by the 'create' and 'update' action of 'ProductController'.
 */
class ProductForm extends CFormModel {

    public $id;
    public $name;
    public $metaTagDescription;
    public $metaTagKeywords;
    public $description;
    public $productTags;
    public $model;
    public $type;
    public $sku;
    public $upc;
    public $ean;
    public $jan;
    public $isbn;
    public $mpn;
    public $location;
    public $price;
    public $taxClass;
    public $quantity;
    public $minimumQuantity;
    public $subtractStock;
    public $outOfStockStatus;
    public $requiresShipping;
    public $seoKeyword;
    public $image;
    public $dateAvailable;
    public $dimensionL;
    public $dimensionW;
    public $dimensionH;
    public $lengthClass;
    public $weight;
    public $weightClass;
    public $status;
    public $sortOrder;
    public $manufacturer;
    public $categories;
    public $filters;
    public $stores;
    public $downloads;
    public $relatedProducts;
    public $specs;
    public $units;
    public $value_init;
    public $value_end;
    
    public $tags;
    public $discount;

    public $primarySpec;
    public $preview;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('name, status', 'required'),
            array('id, price, taxClass, quantity, minimumQuantity, subtractStock, outOfStockStatus, requiresShipping, dimensionW, dimensionH, dimensionL, weight, weightClass, status, sortOrder, manufacturer, preview', 'numerical'),
            array('dateAvailable', 'date', 'format' => 'yyyy-MM-dd'),
            array('discount, primarySpec', 'numerical'),
            array('model, metaTagDescription, metaTagKeywords, description, productTags, model, sku, upc, ean, jan, isbn, mpn, location, seoKeyword, image, categories, filters, stores, downloadas, relatedProducts, type, specs, units, value_init, value_end, tags', 'safe')
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'name' => Yii::t('products', 'Product Name'),
            'metaTagDescription' => Yii::t('products', 'Meta Tag Description'),
            'metaTagKeywords' => Yii::t('products', 'Meta Tag Keywords'),
            'description' => Yii::t('products', 'Description'),
            'productTags' => Yii::t('products', 'Product Tags'),
            'model' => Yii::t('products', 'Serial'),
            'type' => Yii::t('products', 'Type'),
            'sku' => Yii::t('products', 'SKU'),
            'upc' => Yii::t('products', 'UPC'),
            'ean' => Yii::t('products', 'EAN'),
            'jan' => Yii::t('products', 'JAN'),
            'isbn' => Yii::t('products', 'ISBN'),
            'mpn' => Yii::t('products', 'MPN'),
            'location' => Yii::t('products', 'Location'),
            'price' => Yii::t('products', 'Price'),
            'taxClass' => Yii::t('products', 'Tax Class'),
            'taxClass' => Yii::t('products', 'Tax Class'),
            'quantity' => Yii::t('products', 'Quantity'),
            'minimumQuantity' => Yii::t('products', 'Minimum Quantity'),
            'subtractStock' => Yii::t('products', 'Subtract Stock'),
            'outOfStockStatus' => Yii::t('products', 'Out Of Stock Status'),
            'requiresShipping' => Yii::t('products', 'Requires Shipping'),
            'seoKeyword' => Yii::t('products', 'SEO Keyword'),
            'image' => Yii::t('products', 'Image'),
            'dateAvailable' => Yii::t('products', 'Date Available'),
            'dimensionL' => Yii::t('products', 'Dimension L'),
            'dimensionW' => Yii::t('products', 'Dimension W'),
            'dimensionH' => Yii::t('products', 'Dimension H'),
            'lengthClass' => Yii::t('products', 'Lenght Class'),
            'weight' => Yii::t('products', 'Weight'),
            'weightClass' => Yii::t('products', 'Weight Class'),
            'status' => Yii::t('products', 'Status'),
            'sortOrder' => Yii::t('products', 'Sort Order'),
            'manufacturer' => Yii::t('products', 'Brand'),
            'categories' => Yii::t('products', 'Categories'),
            'filters' => Yii::t('products', 'Filters'),
            'stores' => Yii::t('products', 'Stores'),
            'downloads' => Yii::t('products', 'Downloads'),
            'relatedProducts' => Yii::t('products', 'Related Products'),
            'specs' => Yii::t('products', 'Specs'),
            'tags' => Yii::t('products', 'Tags'),
            'discount' => Yii::t('products', 'Discount'),
            'preview' => Yii::t('products', 'Preview'),
        );
    }

    public function getProduct() {
        if (!is_null($this->id) && $this->id != "") {
            return Product::model()->findByPk($this->id);
        }
        return new Product;
    }

    public function loadDataFromProduct($id) {
        $product = Product::model()->findByPk($id);
        if (!is_null($product)) {
            $this->id = $product->product_id;
            $this->name = $product->description->name;
            $this->metaTagDescription = $product->description->meta_description;
            $this->metaTagKeywords = $product->description->meta_keyword;
            $this->description = $product->description->getDescription();
            $this->productTags = $product->description->tag;
            $this->model = $product->model;
            $this->type = $product->type;
            $this->sku = $product->sku;
            $this->upc = $product->upc;
            $this->ean = $product->ean;
            $this->jan = $product->jan;
            $this->isbn = $product->isbn;
            $this->mpn = $product->mpn;
            $this->location = $product->location;
            $this->price = $product->price;
            $this->taxClass = $product->tax_class_id;
            $this->quantity = $product->quantity;
            $this->minimumQuantity = $product->minimum;
            $this->subtractStock = $product->subtract;
            $this->outOfStockStatus = $product->stock_status_id;
            $this->requiresShipping = $product->shipping;
            $this->seoKeyword = $product->getSEOKeyword();
            $this->image = $product->image;
            $this->dateAvailable = $product->date_available;
            $this->dimensionL = $product->length;
            $this->dimensionW = $product->width;
            $this->dimensionH = $product->height;
            $this->lengthClass = $product->length_class_id;
            $this->weight = $product->weight;
            $this->weightClass = $product->weight_class_id;
            $this->sortOrder = $product->sort_order;
            $this->status = $product->status;
            $this->manufacturer = $product->manufacturer_id;
            $this->discount = $product->discount;
            $this->primarySpec = $product->primary_spec;
            $this->preview = $product->preview;

            // Categories
            if (isset($product->categories) && count($product->categories)) {
                foreach ($product->categories as $category)
                    $this->categories[$category->category_id] = $category->description->name;
            }
            
            // Tags
            if (isset($product->tags) && count($product->tags)) {
                foreach ($product->tags as $tag)
                    $this->tags[$tag->tag_text] = $tag->tag_text;
            }

            // Filters
            if (isset($product->filters) && count($product->filters)) {
                foreach ($product->filters as $filter)
                    $this->filters[$filter->filter_id] = $filter->description->name;
            }

            // Stores
            if (isset($product->stores) && count($product->stores)) {
                foreach ($product->stores as $store)
                    $this->stores[$store->store_id] = $store->name;
            }

            // Downloads
            if (isset($product->downloads) && count($product->downloads)) {
                foreach ($product->downloads as $download)
                    $this->downloads[$download->download_id] = $download->description->name;
            }

            // Related Products
            if (isset($product->relatedProducts) && count($product->relatedProducts)) {
                foreach ($product->relatedProducts as $product)
                    $this->relatedProducts[$product->product_id] = $product->description->name;
            }
            
            // Specs & Units
            if(isset($product->specs) && count($product->specs)){
                foreach ($product->specs as $spec){
                    $this->specs[$spec->spec_id] = $spec->description->name;
                    $this->units[$spec->unit_id] = !is_null($spec->unit) ? $spec->unit->name : '';
                    $this->value_init[$spec->spec_id] = $spec->value_init;
                    $this->value_end[$spec->spec_id] = $spec->value_end;
                }
            }
        }
    }

    public function save() {
        $product = Product::model()->findByPk($this->id);
        if (is_null($product)) { // insert   
            // Product
            $product = new Product;
            $product->model = $this->model;
            $product->type = $this->type;
            $product->sku = $this->sku;
            $product->upc = $this->upc;
            $product->ean = $this->ean;
            $product->jan = $this->jan;
            $product->isbn = $this->isbn;
            $product->mpn = $this->mpn;
            $product->location = $this->location;
            $product->price = $this->price;
            $product->discount = $this->discount;
            $product->tax_class_id = $this->taxClass;
            $product->quantity = $this->quantity;
            $product->minimum = $this->minimumQuantity;
            $product->subtract = $this->subtractStock;
            $product->stock_status_id = $this->outOfStockStatus;
            $product->shipping = $this->requiresShipping;
            $product->image = $this->image;
            $product->date_available = $this->dateAvailable;
            $product->length = $this->dimensionL;
            $product->height = $this->dimensionH;
            $product->width = $this->dimensionW;
            $product->weight = $this->weight;
            $product->weight_class_id = $this->weightClass;
            $product->sort_order = $this->sortOrder;
            $product->status = $this->status;
            $product->manufacturer_id = $this->manufacturer;
            $product->primary_spec = $this->primarySpec;
            $product->preview = $this->preview;
            $product->save();
            $this->id = $product->product_id;

            // Description
            $description = new ProductDescription;
            $description->product_id = $product->product_id;
            $description->language_id = 1; // TODO: make this dynamic
            $description->name = $this->name;
            $description->meta_description = $this->metaTagDescription;
            $description->meta_keyword = $this->metaTagKeywords;
            $description->description = $this->description;
            $description->tag = $this->productTags;
            $description->save();
        } else { // update
            // Product
            $product->model = $this->model;
            $product->type = $this->type;
            $product->sku = $this->sku;
            $product->upc = $this->upc;
            $product->ean = $this->ean;
            $product->jan = $this->jan;
            $product->isbn = $this->isbn;
            $product->mpn = $this->mpn;
            $product->location = $this->location;
            $product->price = $this->price;
            $product->discount = $this->discount;
            $product->tax_class_id = $this->taxClass;
            $product->quantity = $this->quantity;
            $product->minimum = $this->minimumQuantity;
            $product->subtract = $this->subtractStock;
            $product->stock_status_id = $this->outOfStockStatus;
            $product->shipping = $this->requiresShipping;
            $product->image = $this->image;
            $product->date_available = $this->dateAvailable;
            $product->length = $this->dimensionL;
            $product->height = $this->dimensionH;
            $product->width = $this->dimensionW;
            $product->weight = $this->weight;
            $product->weight_class_id = $this->weightClass;
            $product->sort_order = $this->sortOrder;
            $product->status = $this->status;
            $product->manufacturer_id = $this->manufacturer;
            $product->primary_spec = $this->primarySpec;
            $product->preview = $this->preview;
            $product->save();

            // Description
            $product->description->name = $this->name;
            $product->description->meta_description = $this->metaTagDescription;
            $product->description->meta_keyword = $this->metaTagKeywords;
            $product->description->description = $this->description;
            $product->description->tag = $this->productTags;
            $product->description->save();
        }
        
        // SEO Keyword
        $product->updateSEOKeyword($this->seoKeyword);

        // Filters
        $product->clearAllFiltersRelations();
        if (isset($this->filters) && count($this->filters) > 0) {
            foreach ($this->filters as $filterId)
                $product->addFilter($filterId);
        }
        
        // Tags
        $product->clearAllTagsRelations();
        if (isset($this->tags) && count($this->tags) > 0) {
            foreach ($this->tags as $tagText)
                $product->addTag($tagText);
        }

        // Categories
        $product->clearAllCategoriesRelations();
        if (isset($this->categories) && count($this->categories)) {
            foreach ($this->categories as $categoryId)
                $product->addToCategory($categoryId);
        }

        // Stores
        $product->clearAllStoresRelations();
        if (isset($this->stores) && count($this->stores)) {
            foreach ($this->stores as $storeId)
                $product->addToStore($storeId);
        }

        // Downloads
        $product->clearAllDownloadsRelations();
        if (isset($this->downloads) && count($this->downloads)) {
            foreach ($this->downloads as $downloadId)
                $product->addToDownload($downloadId);
        }

        // Related Products
        $product->clearAllRelatedProductsRelations();
        if (isset($this->relatedProducts) && count($this->relatedProducts)) {
            foreach ($this->relatedProducts as $relatedId)
                $product->addRelatedProduct($relatedId);
        }
        
        // Specs
        $product->clearAllSpecs();
        if(isset($this->specs) && count($this->specs)){
            foreach ($this->specs as $index => $specId){
                $unitId = isset($this->units[$index]) ? $this->units[$index] : 0;
                $valueStart = isset($this->value_init[$index]) ? $this->value_init[$index] : '';
                $valueEnd = isset($this->value_end[$index]) ? $this->value_end[$index] : '';
                
                if($specId && $valueStart)
                    $product->addSpec($specId, $unitId, $valueStart, $valueEnd);
            }
        }
    }

}
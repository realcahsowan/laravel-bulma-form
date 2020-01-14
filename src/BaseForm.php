<?php

namespace RealCahsowan\LaravelBulmaForm;

use Arr;

class BaseForm {

    protected $id = null;

    protected $orientation = 'vertical';

    protected $fields = [];

    protected $excludedFields = [];

    protected $model = null;

    protected $injected = null;

    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function inject($view)
    {
        $this->injected = $view;
    }

    /**
     * Add new form field
     *
     * @param string $name
     * @param string $type
     * @param array $options
     */
    public function addField($name, $type, $options = [])
    {
        $item = [
            'name' => $name,
            'type' => $type,
            'options' => $options,
        ];

        Arr::set($this->fields, $name, $item);
        return $this;
    }

    /**
     * Remove form field
     *
     * @param string $name
     */
    public function removeField($field)
    {
        if (is_array($field)) {
            $this->excludedFields = array_merge($this->excludedFields, $field);
        } else {
            array_push($this->excludedFields, $field);
        }

        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function build()
    {
        //
    }

    public function getData()
    {
        $this->build();
        $data = [
            'orientation' => $this->orientation,
        ];

        if (! is_null($this->id)) {
            $data['id'] = $this->id;
        }

        if (! is_null($this->model)) {
            foreach ($this->model as $key => $value) {
                $type = Arr::get($this->fields, $key . '.type');
                $category = $type == 'select' ? 'selected' : 'value';

                if ($type == 'radio') {
                    $category = 'checked';
                }

                if ($type == 'checkbox') {
                    $options = Arr::get($this->fields, $key . '.options');
                    $category = Arr::has($options, 'no_value') ? 'value' : 'selected';
                }

                $path = $key . '.options.' . $category;
                Arr::set($this->fields, $path, $value);
            }
        }

        if (! is_null($this->injected)) {
            $data['injected'] =  $this->injected;
        }

        if (count($this->excludedFields)) {
            Arr::forget($this->fields, $this->excludedFields);
        }

        $data['fields'] = $this->fields;

        return $data;
    }

    public function getValidationRules()
    {
        $this->getData();

        $rules = [];

        foreach ($this->fields as $field) {
            if (Arr::has($field['options'], 'rules')) {
                if (Arr::get($field, 'options.multiple')) {
                    $name = $field['name'] . '.*';
                    $rules[$name] = $field['options']['rules'];
                } else {
                    $rules[$field['name']] = $field['options']['rules'];
                }
            }
        }

        return $rules;
    }

    /**
     * Generate form view
     *
     * @param string $method
     * @param string $url
     */
    public function generate($method, $url)
    {
        $data = $this->getData();
        $data['url'] = $url;
        $data['method'] = $method;

        return view('form_builder::master', $data);
    }
}

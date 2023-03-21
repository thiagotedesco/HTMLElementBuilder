<?php

namespace app\classes;

class HtmlElementBuilder{
    private $tag;
    private $attributes = [];
    private $children = [];

    public function __construct( $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Sets an attribute to a given HTML tag
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function setAttribute( $name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Add a child tag
     *
     * @param  \app\classes\HtmlElementBuilder  $child
     * @return $this
     */
    public function addChild(HtmlElementBuilder $child)
    {
        $this->children[] = $child;
        return $this;
    }

    /**
     * Adds an array of children to a given HTML tag
     *
     * @param  array  $children
     * @return $this
     */
    public function addChildren(array $children)
    {
        foreach ($children as $child) {
            if ($child instanceof HtmlElementBuilder) {
                $this->addChild($child);
            } else {
                $this->setContent($child);
            }
        }

        return $this;
    }

    /**
     * Adds content to a tag
     *
     * @param $content
     * @return $this
     */
    public function setContent( $content)
    {
        $this->children[] = $content;
        return $this;
    }

    /**
     * Adiciona código HTML puro
     *
     * @param $content
     * @return $this
     */
    public function setRawContent($content)
    {
        $this->children[] = $content;
        return $this;
    }

    /**
     * Renders the document
     *
     * @return string
     */
    public function render()
    {
        $html = "\n";
        $html .= "<{$this->tag}";

        foreach ($this->attributes as $name => $value) {
            if (is_array($value)) {
                $value = implode(';', $value);
            }
            $html .= " {$name}=\"{$value}\"";
        }

        if (empty($this->children)) {
            $html .= " />";
        } else {
            $html .= ">";
            foreach ($this->children as $child) {
                if ($child instanceof HtmlElementBuilder) {
                    $html .= $child->render();
                } else {
                    $html .= $child;
                }
            }
            $html .= "</{$this->tag}>";
        }

        return $html;
    }
}


<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class SqlParameterBag extends ParameterBag
{
    const ASC  = 'ASC';
    const DESC = 'DESC';

    const LIMIT     = 'limit';
    const OFFSET    = 'offset';
    const ORDER     = 'order';
    const ORDERBY   = 'orderby';
    const PAGE      = 'page';

    const MIN_PAGE = 1;
    const MIN_OFFSET = 0;
    const MAX_LIMIT = 1000;

    /**
     * @param array $parameters An array of parameters
     * @param int $returnType
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
    }

    /**
     * @param mixed $key
     * @param mixed|null $value
     * @param mixed|null $defaultValue
     * @return SqlParameterBag
     */
    public function set($key, $value = null, $defaultValue = null)
    {
        if ($value === null) {
            $value = $defaultValue;
        }

        parent::set($key, $value);
        return $this;
    }


    /**
     * @param Request $request
     * @return SqlParameterBag
     */
    public function setRequest(Request $request):SqlParameterBag
    {
        foreach ($request->query AS $key => $value) {
            switch(strtolower((string) $key)) {
                case self::LIMIT:
                    $this->setLimit($value);
                    break;
                case self::OFFSET:
                    $this->setOffset($value);
                    break;
                case self::ORDER:
                    $this->setOrder($value);
                    break;
                case self::PAGE:
                    $this->setPage($value);
                    break;
                default:
                    $this->set($key, $value);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return ($limit = $this->getInt(self::LIMIT))
            ? $limit
            : null;
    }

    /**
     * @param int $value
     * @return SqlParameterBag
     */
    public function setLimit($value):SqlParameterBag
    {
        $value = abs($value);
        $value = ($value > self::MAX_LIMIT) ? self::MAX_LIMIT : $value;

        $this->set(self::LIMIT, $value);

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset():int
    {
        return $this->getInt(self::OFFSET, ($this->getPage() * $this->getLimit()) - $this->getLimit());
    }

    /**
     * @param int $value
     * @return SqlParameterBag
     */
    public function setOffset($value = self::MIN_OFFSET):SqlParameterBag
    {
        if ($value)
            $this->set(self::OFFSET, abs($value));

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOrder(string $value):SqlParameterBag
    {
        foreach(explode(",",$value) AS $order) {
            $this->setOrderBy($order);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getOrderBy()
    {
        return ($this->hasOrderBy())
            ? $this->get(self::ORDERBY)
            : array();
    }

    /**
     * @param string $value
     * @return SqlParameterBag
     */
    public function setOrderBy(string $value):SqlParameterBag
    {
        @list($order, $by) = explode(':',$value);

        ## Chars Protection
        if (preg_match('/[^a-z0-9_-]/i', $order)) {
            throw new \Exception($order);
        }

        switch(strtoupper($by)) {
            case self::DESC:
                $by = self::DESC;
                break;

            default:
                $by = self::ASC;
        }

        $orderBy = $this->getOrderBy();
        $orderBy[$order] = $by;

        return $this->set(self::ORDERBY, $orderBy);
    }

    /**
     * @return bool
     */
    public function hasOrderBy():bool
    {
        return $this->has(self::ORDERBY);
    }

    /**
     * @param string $value
     * @param string $separator
     * @return array
     */
    public function getArray($value, $separator = ','):array
    {
        return ($arr = explode($separator, $this->get($value)))
            ? $arr
            : array();
    }

    /**
     * @return int
     */
    public function getPage():int
    {
        return $this->getInt(self::PAGE, 1);
    }

    /**
     * @param int $object_count
     * @return int
     */
    public function getPageCount($object_count):int
    {
        return ($this->getLimit())
            ? (int) ceil($object_count / $this->getLimit())
            : 1;
    }

    /**
     * @param int $value
     * @return SqlParameterBag
     */
    public function setPage($value = self::MIN_PAGE):SqlParameterBag
    {
        if (!$value || $value <= 0)
            $value = self::MIN_PAGE;

        $this->set(self::PAGE, abs($value));
        return $this;
    }

}

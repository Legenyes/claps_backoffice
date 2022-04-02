<?php

namespace Infra\Symfony\Utils;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class SqlParameterBag extends ParameterBag
{
    public const ASC  = 'ASC';
    public const DESC = 'DESC';

    public const LIMIT     = 'limit';
    public const OFFSET    = 'offset';
    public const ORDER     = 'order';
    public const ORDERBY   = 'orderby';
    public const PAGE      = 'page';

    public const MIN_PAGE = 1;
    public const MIN_OFFSET = 0;
    public const MAX_LIMIT = 1000;

    /**
     * @param array $parameters An array of parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
    }

    /**
     * @param mixed $key
     * @param mixed|null $value
     * @param mixed|null $defaultValue
     */
    public function set($key, $value = null, $defaultValue = null): SqlParameterBag
    {
        if ($value === null) {
            $value = $defaultValue;
        }

        parent::set($key, $value);
        return $this;
    }


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

    public function getLimit(): ?int
    {
        return ($limit = $this->getInt(self::LIMIT))
            ? $limit
            : null;
    }

    public function setLimit(int $value):SqlParameterBag
    {
        $value = abs($value);
        $value = ($value > self::MAX_LIMIT) ? self::MAX_LIMIT : $value;

        $this->set(self::LIMIT, $value);

        return $this;
    }

    public function getOffset():int
    {
        return $this->getInt(self::OFFSET, ($this->getPage() * $this->getLimit()) - $this->getLimit());
    }

    /**
     * @param int $value
     */
    public function setOffset($value = self::MIN_OFFSET):SqlParameterBag
    {
        if ($value)
            $this->set(self::OFFSET, abs($value));

        return $this;
    }

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

    public function setOrderBy(string $value):SqlParameterBag
    {
        @[$order, $by] = explode(':',$value);

        ## Chars Protection
        if (preg_match('/[^a-z0-9_-]/i', $order)) {
            throw new \Exception($order);
        }

        $by = match (strtoupper($by)) {
            self::DESC => self::DESC,
            default => self::ASC,
        };

        $orderBy = $this->getOrderBy();
        $orderBy[$order] = $by;

        return $this->set(self::ORDERBY, $orderBy);
    }

    public function hasOrderBy():bool
    {
        return $this->has(self::ORDERBY);
    }

    public function getArray(string $value, string $separator = ','):array
    {
        return ($arr = explode($separator, $this->get($value)))
            ? $arr
            : array();
    }

    public function getPage():int
    {
        return $this->getInt(self::PAGE, 1);
    }

    /**
     * @param int $object_count
     */
    public function getPageCount($object_count):int
    {
        return ($this->getLimit())
            ? (int) ceil($object_count / $this->getLimit())
            : 1;
    }

    /**
     * @param int $value
     */
    public function setPage($value = self::MIN_PAGE):SqlParameterBag
    {
        if (!$value || $value <= 0)
            $value = self::MIN_PAGE;

        $this->set(self::PAGE, abs($value));
        return $this;
    }

}

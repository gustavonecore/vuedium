<?php

namespace Leftaro\App\Model\Base;

use \Exception;
use \PDO;
use Leftaro\App\Model\Token as ChildToken;
use Leftaro\App\Model\TokenQuery as ChildTokenQuery;
use Leftaro\App\Model\Map\TokenTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'token' table.
 *
 *
 *
 * @method     ChildTokenQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildTokenQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildTokenQuery orderByDetails($order = Criteria::ASC) Order by the details column
 * @method     ChildTokenQuery orderByExpireDt($order = Criteria::ASC) Order by the expire_dt column
 * @method     ChildTokenQuery orderByCreatedDt($order = Criteria::ASC) Order by the created_dt column
 * @method     ChildTokenQuery orderByUpdatedDt($order = Criteria::ASC) Order by the updated_dt column
 * @method     ChildTokenQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method     ChildTokenQuery groupById() Group by the id column
 * @method     ChildTokenQuery groupByType() Group by the type column
 * @method     ChildTokenQuery groupByDetails() Group by the details column
 * @method     ChildTokenQuery groupByExpireDt() Group by the expire_dt column
 * @method     ChildTokenQuery groupByCreatedDt() Group by the created_dt column
 * @method     ChildTokenQuery groupByUpdatedDt() Group by the updated_dt column
 * @method     ChildTokenQuery groupByUserId() Group by the user_id column
 *
 * @method     ChildTokenQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTokenQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTokenQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTokenQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTokenQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTokenQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTokenQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildTokenQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildTokenQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildTokenQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildTokenQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildTokenQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildTokenQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \Leftaro\App\Model\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildToken findOne(ConnectionInterface $con = null) Return the first ChildToken matching the query
 * @method     ChildToken findOneOrCreate(ConnectionInterface $con = null) Return the first ChildToken matching the query, or a new ChildToken object populated from the query conditions when no match is found
 *
 * @method     ChildToken findOneById(string $id) Return the first ChildToken filtered by the id column
 * @method     ChildToken findOneByType(string $type) Return the first ChildToken filtered by the type column
 * @method     ChildToken findOneByDetails(string $details) Return the first ChildToken filtered by the details column
 * @method     ChildToken findOneByExpireDt(string $expire_dt) Return the first ChildToken filtered by the expire_dt column
 * @method     ChildToken findOneByCreatedDt(string $created_dt) Return the first ChildToken filtered by the created_dt column
 * @method     ChildToken findOneByUpdatedDt(string $updated_dt) Return the first ChildToken filtered by the updated_dt column
 * @method     ChildToken findOneByUserId(int $user_id) Return the first ChildToken filtered by the user_id column *

 * @method     ChildToken requirePk($key, ConnectionInterface $con = null) Return the ChildToken by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOne(ConnectionInterface $con = null) Return the first ChildToken matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildToken requireOneById(string $id) Return the first ChildToken filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOneByType(string $type) Return the first ChildToken filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOneByDetails(string $details) Return the first ChildToken filtered by the details column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOneByExpireDt(string $expire_dt) Return the first ChildToken filtered by the expire_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOneByCreatedDt(string $created_dt) Return the first ChildToken filtered by the created_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOneByUpdatedDt(string $updated_dt) Return the first ChildToken filtered by the updated_dt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildToken requireOneByUserId(int $user_id) Return the first ChildToken filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildToken[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildToken objects based on current ModelCriteria
 * @method     ChildToken[]|ObjectCollection findById(string $id) Return ChildToken objects filtered by the id column
 * @method     ChildToken[]|ObjectCollection findByType(string $type) Return ChildToken objects filtered by the type column
 * @method     ChildToken[]|ObjectCollection findByDetails(string $details) Return ChildToken objects filtered by the details column
 * @method     ChildToken[]|ObjectCollection findByExpireDt(string $expire_dt) Return ChildToken objects filtered by the expire_dt column
 * @method     ChildToken[]|ObjectCollection findByCreatedDt(string $created_dt) Return ChildToken objects filtered by the created_dt column
 * @method     ChildToken[]|ObjectCollection findByUpdatedDt(string $updated_dt) Return ChildToken objects filtered by the updated_dt column
 * @method     ChildToken[]|ObjectCollection findByUserId(int $user_id) Return ChildToken objects filtered by the user_id column
 * @method     ChildToken[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TokenQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Leftaro\App\Model\Base\TokenQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Leftaro\\App\\Model\\Leftaro\\App\\Model\\Token', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTokenQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTokenQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTokenQuery) {
            return $criteria;
        }
        $query = new ChildTokenQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildToken|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TokenTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TokenTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildToken A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, type, details, expire_dt, created_dt, updated_dt, user_id FROM token WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildToken $obj */
            $obj = new ChildToken();
            $obj->hydrate($row);
            TokenTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildToken|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TokenTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TokenTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the details column
     *
     * Example usage:
     * <code>
     * $query->filterByDetails('fooValue');   // WHERE details = 'fooValue'
     * $query->filterByDetails('%fooValue%', Criteria::LIKE); // WHERE details LIKE '%fooValue%'
     * </code>
     *
     * @param     string $details The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByDetails($details = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($details)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_DETAILS, $details, $comparison);
    }

    /**
     * Filter the query on the expire_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByExpireDt('2011-03-14'); // WHERE expire_dt = '2011-03-14'
     * $query->filterByExpireDt('now'); // WHERE expire_dt = '2011-03-14'
     * $query->filterByExpireDt(array('max' => 'yesterday')); // WHERE expire_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $expireDt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByExpireDt($expireDt = null, $comparison = null)
    {
        if (is_array($expireDt)) {
            $useMinMax = false;
            if (isset($expireDt['min'])) {
                $this->addUsingAlias(TokenTableMap::COL_EXPIRE_DT, $expireDt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($expireDt['max'])) {
                $this->addUsingAlias(TokenTableMap::COL_EXPIRE_DT, $expireDt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_EXPIRE_DT, $expireDt, $comparison);
    }

    /**
     * Filter the query on the created_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedDt('2011-03-14'); // WHERE created_dt = '2011-03-14'
     * $query->filterByCreatedDt('now'); // WHERE created_dt = '2011-03-14'
     * $query->filterByCreatedDt(array('max' => 'yesterday')); // WHERE created_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdDt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByCreatedDt($createdDt = null, $comparison = null)
    {
        if (is_array($createdDt)) {
            $useMinMax = false;
            if (isset($createdDt['min'])) {
                $this->addUsingAlias(TokenTableMap::COL_CREATED_DT, $createdDt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdDt['max'])) {
                $this->addUsingAlias(TokenTableMap::COL_CREATED_DT, $createdDt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_CREATED_DT, $createdDt, $comparison);
    }

    /**
     * Filter the query on the updated_dt column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedDt('2011-03-14'); // WHERE updated_dt = '2011-03-14'
     * $query->filterByUpdatedDt('now'); // WHERE updated_dt = '2011-03-14'
     * $query->filterByUpdatedDt(array('max' => 'yesterday')); // WHERE updated_dt > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedDt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByUpdatedDt($updatedDt = null, $comparison = null)
    {
        if (is_array($updatedDt)) {
            $useMinMax = false;
            if (isset($updatedDt['min'])) {
                $this->addUsingAlias(TokenTableMap::COL_UPDATED_DT, $updatedDt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedDt['max'])) {
                $this->addUsingAlias(TokenTableMap::COL_UPDATED_DT, $updatedDt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_UPDATED_DT, $updatedDt, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(TokenTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(TokenTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokenTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query by a related \Leftaro\App\Model\User object
     *
     * @param \Leftaro\App\Model\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTokenQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \Leftaro\App\Model\User) {
            return $this
                ->addUsingAlias(TokenTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TokenTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \Leftaro\App\Model\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Leftaro\App\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Leftaro\App\Model\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildToken $token Object to remove from the list of results
     *
     * @return $this|ChildTokenQuery The current query, for fluid interface
     */
    public function prune($token = null)
    {
        if ($token) {
            $this->addUsingAlias(TokenTableMap::COL_ID, $token->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the token table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TokenTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TokenTableMap::clearInstancePool();
            TokenTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TokenTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TokenTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TokenTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TokenTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TokenQuery
